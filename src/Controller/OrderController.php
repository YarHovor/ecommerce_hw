<?php

namespace App\Controller;

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
}