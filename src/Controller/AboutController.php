<?php

namespace App\Controller; // пространств имен

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index()
    {
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }

    /**
     * @Route("/contact", name="about_contact")
     */
    public function contact()
    {
        $name = 'Anonymous';
        $pass = 'nopass';

        return $this->render('about/contact.html.twig', [
            //второй парметр массив
            'userName' => $name,
            'password' => $pass,
        ]);
    }
}
