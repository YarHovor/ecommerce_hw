<?php

namespace App\Form;

use Symfony\Component\Form\CallbackTransformer;


// сделано для того чтобы корректно отображало цену
//
class MoneyTransformer extends CallbackTransformer
{
    // в конструкторе две ф-и, для преобразаование в одну сторону и в другую
    public function __construct()
    {
        parent::__construct(
            function ($valueInCents) {
                return sprintf('%0.2f', $valueInCents / 100); // 1:05 в видосе !!!!
            },
            function ($value) {
                return is_numeric($value) ? round($value * 100) : $value;
            }
        );
    }

}
