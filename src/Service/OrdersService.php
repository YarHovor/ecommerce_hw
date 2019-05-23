<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrdersService
{
    const CART_SESSION_KEY = 'cart'; //ключик для сохранения значения, чтобы не писать несколько раз

    private $session; //сохраняем в отдельное свойство

    private $orderRepository; //свойство

    private $entityManager; // свойство для менеджера

    public function __construct(
        SessionInterface $session, // метод для роботы с сессиями
        OrderRepository $orderRepository, // для вытягивания данных из базы (заказ)
        EntityManagerInterface $entityManager // для сохранение в базу, метод этот нужен
    ) {
        $this->session = $session; //сохранение
        $this->orderRepository = $orderRepository; // сохранять ээто свойство в полусенное значение
        $this->entityManager = $entityManager;
    }

    public function getOrderFromCart()
    {
        $order = null; // переменная пустая, для того чтобы чекать заказ наличие

        //пробуем достать ид заказа (берем по сессии значения с ключем лежайшее в константе
        $orderId = $this->session->get(self::CART_SESSION_KEY);


        // если нулл то делаем новый заказ
        if ($orderId) { // евсли в нашей сессии нашелся ИД заказа, загружаем из базы (репозиторий помогает вытягивать данные из базы)
            $order = $this->orderRepository->find($orderId); // пробуем загрузить с помощью репозитория
        }
        if (!$order) { // если не нашелся заказ
            $order = new Order(); // то создаем новый
        }
        return $order;// возвращаем заказ
    }

    public function addToCart(Product $product, int $count = 1): Order // методд добавление товаров в корзину (передаем товар и к-во)
    {
        $order = $this->getOrderFromCart(); // получаем заказ из сессии
        // проверка есть ли этот продукт в списке товаров ( делаем чтобы было написано 2шт того 5шт того)
        $orderItem = null; //
        foreach ($order->getOrderItems() as $item) { // проверить (есть список, по нему пробегаемся)
            if ($item->getProduct() === $product) { //если у этого продукта совпадает с тем которым добавляем
                $orderItem = $item; // должны использовать этот ордерИтем
            }
        }

        if (!$orderItem) { // если у нас нет ордеритем
            $orderItem = new OrderItem(); // нужно создавать новый
            $orderItem->setProduct($product); // и ставить там нужный товар
            $order->addOrderItem($orderItem); // затем добавить в наш заказ новый ордерИтем
        }
        // нужно увеличить к-во товаров в ордерИтем на  новыое значение
        $orderItem->setCount($orderItem->getCount() + $count); // берем старое значение и добавляем новое, потом сохранить новое

        // и нужно сохранить все в базе, а для того нужен метод ентитиМенеджер
        $this->entityManager->persist($order); // сохраняем заказ (отслеживает)
        $this->entityManager->flush(); // само сохранение
        $this->session->set(self::CART_SESSION_KEY, $order->getId()); // в сессии сохраняем ИД заказа, с помощью ключа

        return $order; // возвращаем из метода зазказ
    }

    // метод который изменит к-во
    public function setCount(OrderItem $orderItem, int $count): Order
    {
        $orderItem->setCount($count); // добавляем к-во
        $this->entityManager->flush(); //сохраняем в БД
        return $orderItem->getOrder(); //вернуть заказ
    }

    public function deleteItem(OrderItem $orderItem): Order // метод для удаление товаров, вовращ Ордер
    {
        $order = $orderItem->getOrder();            //взяли заказ
        $order->removeOrderItem($orderItem);        // вызыв метод
        $this->entityManager->remove($orderItem);
        $this->entityManager->flush();              // сохр в БД
        return $order;                              // вернуть заказ
    }
}