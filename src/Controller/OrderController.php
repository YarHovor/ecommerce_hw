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
        if ($request->isXmlHttpRequest()) {  // берем
            return $this->headerCart($ordersService);   //
        }
        //надо бросить пользователя туда где он тыклнул эту кнопку
        //береm ссылку на которой он был до этого, ссылкой типа
        // берем реквест  - берем его хедерс - и берем этот заголовок
        $referer = $request->headers->get('Referer');   //
        //и кидаем пользователя туда откуда он пришел.
        return $this->redirect($referer);   //
    }
}