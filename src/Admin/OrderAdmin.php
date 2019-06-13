<?php


namespace App\Admin;

use App\Form\MoneyTransformer;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class OrderAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('user')
            ->addIdentifier('createdAt')
            ->addIdentifier('status')
            ->addIdentifier('isPaid')
            ->add('amount')
            ->add('phone')
            ->add('email');
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('user')
            ->add('createdAt')
            ->add('status')
            ->add('isPaid')
            ->add('amount')
            ->add('phone')
            ->add('email');
    }
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('id')
            ->add('user')
            ->add('createdAt')
            ->add('status')
            ->add('isPaid')
            ->add('amount', NumberType::class, [  // для валидации
                'scale' => 2, // 2 знака после запятой
                'attr' => ['class' => 'js-amount', 'readonly'] // аттр - выводит HTML трибуты
            ])
            ->add('phone')
            ->add('email')
            ->add('address')
            ->add(      // добавляем ОрдерИтемс
                'orderItems',
                CollectionType::class, // с елементом в форме колекции
                [
                    'by_reference' => false  // нужен для работы со свзяаной сущностью
                ],
                [
                    // режимы отображение
                    'edit' => 'inline',  // редактировать же можно тут
                    'inline' => 'table', // и чтобы выглядело в виде таблицы
                ]
            );
        $form->get('amount')->addModelTransformer(new MoneyTransformer()); // мани трансформер, и форма будет вызывать его для преобразование
    }
    // теперь надо добавить роут к методу (Админ/ОрдерКонтроллер)
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('recalc', $this->getRouterIdParameter() . '/recalc');   // вот так вот, +1 маршрут к админке
    }
}