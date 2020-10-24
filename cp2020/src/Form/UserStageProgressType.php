<?php

namespace App\Form;

use App\Entity\Stage;
use App\Entity\User;
use App\Entity\UserStageProgress;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserStageProgressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', NumberType::class, [
                'label' => 'Статус'
            ])
            ->add('User', EntityType::class, [
                'label' => "Пользователь",
                'class' => User::class,
                'choice_label' => 'email',
                'required' => true
            ])
            ->add('Stage', EntityType::class, [
                'label' => "Этап",
                'class' => Stage::class,
                'choice_label' => 'title',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserStageProgress::class,
        ]);
    }
}
