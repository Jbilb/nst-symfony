<?php

namespace App\Form\Admin;

use App\Entity\Article;
use App\Form\LinkFormType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('cover_image')
            ->add('date_publication')
            ->add('intro_text', CKEditorType::class)
            ->add('body_texts', CollectionType::class, [
                'entry_type' => CKEditorType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('body_titles', CollectionType::class, [
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('body_images')
            ->add('body_galeries')
            ->add('body_cta')
            ->add('body_links', CollectionType::class, [
                'entry_type' => LinkFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('body_videos', CollectionType::class, [
                'attr' => [
                    'placeholder' => "Entrez l'URL de votre vidéo (Youtube / Viméo) :",
                ],
                'entry_type' => TextType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('body_pdf')
            ->add('body_html_element', CollectionType::class, [
                'entry_type' => CKEditorType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
            ->add('lectures')
            ->add('is_active')
            ->add('featured')
            ->add('slug')
            ->add('categorie')
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}