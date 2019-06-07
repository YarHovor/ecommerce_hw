<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;

// сервис для отправки писем

class Mailer
{
    /**
     * @var Environment
     */
    private $templating;  // твиг (для того чтобы можно было отправлять шаблон типа)
    /**
     * @var \Swift_Mailer
     */
    private $mailer;    //
    /**
     * @var string
     */
    private $fromEmail; // для адресса

    // получаем конструктор
    public function __construct(Environment $templating, \Swift_Mailer $mailer, ParameterBagInterface $parameterBag)
    {
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->fromEmail = $parameterBag->get('from_email'); // от сервис.ямл достанет значение фром_имейл
    }


    // метод ( указываем              (шаблон,     получателя, переменные для шаблона))
    public function sendMessage(string $template, array $to, array $context)
    {
        $twig = $this->templating->load($template);     // из шаблона достаем блоки
       // из шаблона получем тело и тему письма
        $subject = $twig->renderBlock('subject', $context);     // рендерит твиг теги
        $body = $twig->renderBlock('body', $context);

      // делаем сообщение
        $message = new \Swift_Message();        // сообщение
        $message->setTo($to);       //
        $message->setSubject($subject);
        $message->setBody($body, 'text/html');
        $message->setFrom($this->fromEmail);        // адресс отправителя

        // ОТПРАВКА СООБЩЕНИЕ
        $this->mailer->send($message);
    }
}