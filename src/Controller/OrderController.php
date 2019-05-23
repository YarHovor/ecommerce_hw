<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use App\Service\OrdersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order/add-to-cart/{id}", name="order_add_to_cart")
     */
    // метод.
    public function addToCart(Product $product, OrdersService $ordersService, Request $request) // по ИД продукт
    {
        // с помощью сервиса вызвать один метод и вернутся на туже страницу
        // Реквест - нужен для http запроса

        $ordersService->addToCart($product);  // говорим - добавь в корзину наш продукт

        // а потом пользователя надо перебросить на туже страницу на которой он нажал эту кнопку.

        // для AJAX
        if ($request->isXmlHttpRequest()) {  // метод возвращает ТРУ если запрос пришел Аяксом
            return $this->headerCart($ordersService);   // возвращаем то что рисует ХедерКарт
        }


        //надо бросить пользователя туда где он тыклнул эту кнопку
        //береm ссылку на которой он был до этого, ссылкой типа
        // берем реквест  - берем его хедерс - и берем этот заголовок
        $referer = $request->headers->get('Referer');   //
        //и кидаем пользователя туда откуда он пришел.
        return $this->redirect($referer);   //
    }

    //Сделать метод \App\Controller\OrdersController::cart()
    //c шаблоном templates/orders/cart.html.twig

    //делаем метод и аннотациию (УРЛ)
    /**
     * @Route("/cart", name="order_cart")
     */
    public function cart(OrdersService $ordersService) // парметр ордерСервис
    {
        return $this->render('order/cart.html.twig', [ // и шаьлон ордер
            'order' => $ordersService->getOrderFromCart(), // передадим сущность заказа.
        ]);
    }


    // аннотации нету, бо его не будем грузить как отдельную страницу, а просто будет отображатся на всех
    // этот метод нужен для того чтобы рядом с корзиной писало сумму добавленных в корзину.
    public function headerCart(OrdersService $ordersService) // тоже надо ОрдерСервис
    {
        return $this->render('order/headerCart.html.twig', [ // шаблон
            'order' => $ordersService->getOrderFromCart(), //
        ]);
    }

    /**
     * @Route("/cart/update-count/{id}", name="order_update_count")
     */
    public function updateCount(OrderItem $orderItem, OrdersService $ordersService, Request $request)
    {
        // совпадает ли текущая корзина с текущим пользователем с заказом ордерИтем
        $order = $ordersService->getOrderFromCart();  // сервис для проверки

        // защита от хакера
        if ($orderItem->getOrder() !== $order) {   // берем текущую корзину, и если ордерИтем не= текущей корзине
            return $this->createAccessDeniedException('Invalid order item'); // то
        }
        // а если хорошо надо обновить к-во и отдать ту же самую табличку
        $count = $request->request->getInt('count');  // к-во передаем
        $ordersService->setCount($orderItem, $count); // используем метод
        return $this->render('order/cartTable.html.twig', [ // ответ - отрисование таблицы в отдельный шаблон
            'order' => $order,   //
        ]);
    }


    // метод для удаление в корзины в контроллере
    /**
     * @Route("/cart/delete-item/{id}", name="order_delete_item")
     */
    public function deleteItem(OrderItem $orderItem, OrdersService $ordersService, Request $request)
    {

        $order = $ordersService->getOrderFromCart();  // сервис для проверки

        // защита от хакера ( с апдейта стырино )
        if ($orderItem->getOrder() !== $order) {   // берем текущую корзину, и если ордерИтем не= текущей корзине
            return $this->createAccessDeniedException('Invalid order item'); // то
        }
        $ordersService->deleteItem($orderItem);
        if ($request->isXmlHttpRequest()) {     // если пришел Аяксом
            return $this->render('order/cartTable.html.twig', [     // табличку вовращаем
                'order' => $order,
            ]);
        }

        // если не то редирект на ту же страницу с корзиной.
        return $this->redirectToRoute('order_cart');
    }
}