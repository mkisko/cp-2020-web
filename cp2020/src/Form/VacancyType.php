<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Skill;
use App\Entity\User;
use App\Entity\Vacancy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VacancyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('minCost')
            ->add('maxCost')
            ->add('typeIntern')
            ->add('Expired')
            ->add('PublichedAt')
            ->add('conditions')
            ->add('company', EntityType::class, [
                'label' => "Компания",
                'class' => Company::class,
                'choice_label' => 'title',
                'required' => true
            ])
            ->add('city')
            ->add('user', EntityType::class, [
                'label' => "Пользователь",
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
