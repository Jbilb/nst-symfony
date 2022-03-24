<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Liste des offres New School Tacos')
            ->setPageTitle('edit','Editer une offre')
            ->setPageTitle('new', 'Ajouter une offre')
            ->setPaginatorPageSize(10)
            ->renderContentMaximized()
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter une offre');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('éditer');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('supprimer');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Enregistrer');
            })
            ->remove(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)
            ->setPermission(Action::NEW, 'ROLE_ADMIN')
            ->setPermission(Action::EDIT, 'ROLE_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', "Titre de l'offre"),
            TextField::new('titleVignette', "Titre de la vignette"),
            TextEditorField::new('description', "Description"),
            DateField::new('dateStart', "Date de début d'offre"),
            DateField::new('dateEnd', "Date de fin de l'offre"),
            ImageField::new('imageVignette', "Image de la vignette"),
            ImageField::new('imagePhoto', "Photo"),
            ImageField::new('imageDesktop', "Image Desktop"),
            ImageField::new('imageMobile', "Image Mobile"),
            TextField::new('textButton', "Texte du bouton (facultatif)"),
            TextField::new('urlButton', "Lien url du bouton (facultatif)"),
            BooleanField::new('isPublished', "Publié"),
            BooleanField::new('isFeatured', "Offre en une (page index)")
        ];
    }
}
