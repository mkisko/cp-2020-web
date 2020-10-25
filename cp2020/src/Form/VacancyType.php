<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Skill;
use App\Entity\User;
use App\Entity\Vacancy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VacancyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Название вакансии'
            ])
            ->add('description', TextType::class, [
                'label' => 'Описание вакансии'
            ])
            ->add('minCost', TextType::class, [
                'label' => 'Минимальная зарплата'
            ])
            ->add('maxCost', TextType::class, [
                'label' => 'Максимальная запрата'
            ])
            ->add('typeIntern', ChoiceType::class, [
                'label' => 'Возможна ли стажировка',
                'choices' => [
                    'Да' => '1',
                    'Нет' => '0'
            ]])
            ->add('conditions', TextareaType::class, [
                'label' => 'Условия работы'
            ])
            ->add('company', EntityType::class, [
                'label' => "Компания",
                'class' => Company::class,
                'choice_label' => 'title',
                'required' => true
            ])
            ->add('city', TextType::class, [
                'label' => 'Город'
            ])
            ->add('user', EntityType::class, [
                'label' => "Менеджер",
                'class' => User::class,
                'choice_label' => 'email',
                'required' => true
            ])
            ->add('skills', EntityType::class, [
                'label' => "Навыки",
                'class' => Skill::class,
                'choice_label' => 'title',
                'multiple' => 'true',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vacancy::class,
        ]);
    }
}
