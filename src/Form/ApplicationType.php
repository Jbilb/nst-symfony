<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'placeholder' => 'Ton nom et prénom'
                ],
                'required' => true
            ])
            ->add('phone', null, [
                'attr' => [
                    'placeholder' => 'Ton numéro de téléphone'
                ],
                'required' => true
            ])
            ->add('email', null, [
                'attr' => [
                    'placeholder' => 'Ton adresse email'
                ],
                'required' => true
            ])
            ->add('restaurant', EntityType::class, [
                'class' => Restaurant::class,
                'choice_label' => 'name',
                'required' => true
            ])
            ->add('job', ChoiceType::class, [
                'choices' => [
                    'cheese' => 'Team Cheese',
                    'grill' => 'Team Grill'
                ],
                'required' => true
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Ton message'
                ],
                'required' => true
            ])
            ->add('file', FileType::class, [
                'required' => false
            ])
            ->add('consentement', CheckboxType::class, [
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
