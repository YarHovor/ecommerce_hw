<?php
namespace App\Form;
use App\Entity\FeedBackRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;


class FeedbackRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null,[
                'label' => 'Имя', // слева надпись Имя
                'attr' => [
                    'placeholder' => 'Введите имя', // в инпуте надпись
                ],
            ])
            // второй параметр в метода адд это тип поля, будем рисовать поле є-майл таким вот способом
            ->add('email', EmailType::class,[
                'attr' => [
                    'placeholder' => 'Введите email', // в инпуте надпись
                ],
            ])
            // для топика чойсТайп
            ->add('topic', ChoiceType::class, [
                'choices' => array_flip(FeedBackRequest::$topics), // указывается собственно тот список что в сущности
                'placeholder' => 'Выберите тему', // в инпуте надпись
                'label' => 'Тема',  // слева надпись Тема
            ])
            ->add('message', null,[
                'label' => 'Сообщение',  // слева надпись Сообщение
                'attr' => [
                    'placeholder' => 'Введите сообщение ...', // в инпуте надпись
                ],
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FeedBackRequest::class,
        ]);
    }
}