<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    // стартовая страница
    /**
     * @Route("/", name="default")
     */
    // добавление сервисов. Вид класса с помощью которой меняется поведение проги
    // надо прописать репозиторий(он по сути сервис), вибирать нужно из списка чтоб узе появился, і название переменной $
    public function index(ProductRepository $productRepository)
    {
        // виборка товаров
        // и теперь с вомощью репозитория, можно достать продукти і сохранить їх в переменную

        $products = $productRepository->findAll();
        // и в переменной продуктс получится массив из об'єктотв продукт со всеми загруженними данними із таблици


        // передаем продукти в шаблон.
        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);
    }

    // прикол с маршрутизацией

    // страничка одного продукта

    /**
     * @Route("/product/{id}", name="product")
     */
    // можно подгружать через сущность
    // симфони само подгружает
    // если в нотроллере в параметрах упомянута сущность и
    // есть переменная то симфони с помощью доктрини достает цю сущность из БД по полю
    public function product(Product $product) // сущность класса Product  (App/Entity)
                                              // и репозиторий не надо
    {
         return $this->render('default/product.html.twig', [
            'product' => $product, // передаем найденіий товар
        ]);
    }
    // -----------------------------------------------------------------------
    /*
    // можно передавать переменную, таким образом в УРЛ переменная
    // если об'явить в методе парметр с таким же именем как переменная в УРЛ
    // то значение из УРЛ попадет в єто значение (вместо предперемменних)
    //
    // Задача, по єтому ИД ддостать продукт и показать о нем информацию.
    public function product($id, ProductRepository $productRepository)
    {
        // достаем сам товар, метод которій может вітягівать сущность по ИД
        $product = $productRepository->find($id);

        // если же нет проодукта такого, ми должни
        // указать страницу 404
        if(!$product){
            return $this->createNotFoundException('Product #' . $id . ' not found.');
        }

        // а если же нашлось ми виводим шаблон
        return $this->render('default/product.html.twig', [
            'product' => $product, // передаем найденіий товар
        ]);
    }
    */
}