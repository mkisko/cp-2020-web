<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Имя'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Фамилия'
            ])
            ->add('middlename', TextType::class, [
                'label' => 'Отчество'
            ])
            ->add('city', TextType::class, [
                'label' => 'Город'
            ])
            ->add('country', TextType::class, [
                'label' => 'Страна'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'О себе'
            ])
            ->add('educations', CollectionType::class, [
                'entry_type' => UserEducationType::class,
                'entry_options' => ['label' => false ],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
