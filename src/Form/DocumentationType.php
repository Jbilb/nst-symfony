<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'placeholder' => 'Nom et prénom*'
                ],
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Ton adresse email'
                ],
                'required' => true
            ])
            ->add('city', null, [
                'attr' => [
                    'placeholder' => 'Ville d\'implantation*'
                ],
                'required' => true
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
