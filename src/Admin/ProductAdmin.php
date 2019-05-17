<?php
namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list) //метод
    {
        $list                                           // листмейпер
        //метод адд, для добавление інфи о колонсках списка.
        // Смотрим что за поля есть в Сущности и что будет показувати в списке
            ->addIdentifier('name')
            ->add('categories')
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
            ->add('categories')
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
            ->add('categories')
            ->add('description')
            ->add('price')
            ->add('count')
            ->add('isTop')
            ->add('image', VichImageType::class, [
                'required' => false,  // выкл обезательность рекваер (юбо будет писать что файл нужно выбрать, хоть не хоч менять)
            ]);
        ;
    }
}