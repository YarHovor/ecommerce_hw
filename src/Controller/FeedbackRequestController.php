<?php

namespace App\Controller;

use App\Entity\FeedbackRequest;
use App\Form\FeedbackRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackRequestController extends AbstractController
{
    /**
     * @Route("/feedback/request", name="feedback_request")
     */
    public function index(Request $request, EntityManagerInterface $entityManager) //получаем данные запроса через параметр
        //   ЕнтитиМенеджерИнтерфейс - менеджер для сохранения в базу (если нужно записать в базу то репозиторий, если сохранить то менеджер)
    {
        //создали новый объект из сущности
        $feedbackRequest = new FeedbackRequest(); // Объект для данных этой формы (новый объект из сущности)
        //
        $form = $this->createForm(FeedbackRequestType::class, $feedbackRequest); // форма, таким вот методом
        // метод креатеФорм слздает объет формы на основе этого класса, и использую феедбекреквест в в качестве хранилища данных,
        // и отображение формы "отдали" в шаблон

        $form->handleRequest($request); // "говорим" форме забери ты данные с запроса

        if($form->isSubmitted() && $form->isValid()){  // проверка была ли форма отправлена и правильно все в нее введенно
            // если сделано, то
            $entityManager->persist($feedbackRequest);  // метод персист - доктрина следит за изменениями
            $entityManager->flush();                    // метод флаш - сохранения изменений в процесси работы с базы в базу

            return $this->redirectToRoute('feedback_request_success'); // переадрессация на спс за обращение
        }
        return $this->render('feedback_request/index.html.twig', [
            'form' => $form->createView(), // нужно передать в шаблон нетипросто класс формы и ее View, вот так вот.
        ]);
    }

    // после того как сохранили нужно сказать пользователю "спасибо за обращени"
    // метод для рисования шаблона с благодарностью
    /**
     * @Route("/feedback/success", name="feedback_request_success")
     */
    public function success()
    {
        return $this->render('feedback_request/success.html.twig');
    }
}