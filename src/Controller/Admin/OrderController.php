<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use App\Form\MoneyTransformer;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\JsonResponse;

// 1:40
// в конфиг - соната_админ надо в админ ордере добавить строку аргументс с названием контроллера (вместо последней ~)
class OrderController extends CRUDController  //
{
    // метод который занимаеться пересчетом данных
    public function recalcAction($id)       //  пересчет по ид заказа
    {
        $object = $this->admin->getSubject();       //
        $form = $this->admin->getForm();            //
        if (!\is_array($fields = $form->all()) || 0 === \count($fields)) {  //
            throw new \RuntimeException(                                    //
                'No editable field defined. Did you forget to implement the "configureFormFields" method?'
            );
        }
        $form->setData($object);        //
        $form->handleRequest($this->getRequest());     //
        if ($form->isSubmitted()) {             //
            $isFormValid = $form->isValid();        //
            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode() || $this->isPreviewApproved())) {        //

                /** @var Order $submittedObject */
                $submittedObject = $form->getData();        // пересчет тута типа
                foreach ($submittedObject->getOrderItems() as $item) {      // переход по всем айтеисам
                    $item->updateAmount();      // и
                }

                $transformer = new MoneyTransformer();      // трансформер с копеек в грн
                $result = [         //
                    'amount' => $transformer->transform($submittedObject->getAmount()),     //
                    'items' => [],      //
                ];
                foreach ($submittedObject->getOrderItems() as $item) {      // потом опятьь по ордер айтемс
                    $result['items'][] = $transformer->transform($item->getAmount());       // и обновляем/заполняем
                }
                return new JsonResponse($result);       // в виде ДжейсонРеспон вернем
            }
        }
        return new JsonResponse(false);     // если мимо - то вернем тоже Джейсон но фалсе
    }
}