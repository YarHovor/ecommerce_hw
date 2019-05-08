<?php
namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list) //метод
    {
        $list                                           // листмейпер
        //метод адд, для добавление інфи о колонсках списка.
        // Смотрим что за поля есть в Сущности и что будет показувати в списке
            ->addIdentifier('name')
            ->addIdentifier('description')
            ->add('price')
            ->add('count')
            ->add('isTop')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('count')
            ->add('isTop')
        ;
    }
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('count')
            ->add('isTop')
        ;
    }
}