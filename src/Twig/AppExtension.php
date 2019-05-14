<?php


namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;


class AppExtension extends AbstractExtension
{
    public function getFilters() // делаем фильтр
    {
        return [
            new TwigFilter('money', [$this, 'formatMoney']), // добавляем фильтр который будет называтся Мани, а для его работы будет вызыватся метод форматМетод ниже
        ];
    }
    public function formatMoney($value)
    {
        return twig_localized_currency_filter($value / 100, 'UAH'); // значение в копейках делить на 100 и подставлять значек грн
    }
}