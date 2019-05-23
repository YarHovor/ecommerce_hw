<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        $categorys = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categorys' => $categorys,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */

    public function show($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        if(!$category){
            return $this->createNotFoundException('Category #' . $id . ' not found.');
        }

        return $this->render('category/category_show.html.twig', [
            'category' => $category,
        ]);
    }

    // для категорий в шапке
    public function headerCategories(CategoryRepository $categoryRepository)
    {
        return $this->render('category/header.html.twig',[      // шаблон, который не нужнается от базового
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']), // массив так передают
        ]);
    }

}


