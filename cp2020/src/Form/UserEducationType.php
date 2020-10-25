<?php

namespace App\Form;

use App\Entity\Education;
use App\Entity\UserEducation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class UserEducationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Начало обучения',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Окончание обучения',
                'required' => false
            ])
            ->add('Education', EntityType::class, [
                'label' => "Образование",
                'class' => Education::class,
                'choice_label' => 'title',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserEducation::class,
        ]);
    }
}
