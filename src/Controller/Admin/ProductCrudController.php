<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\CategoryType;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter un produit');
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
            TextField::new('name', 'Nom du produit'),
            AssociationField::new('category', 'Catégorie')->setCrudController(CategoryCrudController::class),
            // CollectionField::new('category')
            //     ->hideOnIndex()
            //     ->setLabel('Catégorie')
            //     ->setTemplatePath('admin/category.html.twig')
            //     ->setFormTypeOptions([
            //         'label' => false,
            //         'delete_empty' => true,
            //         'by_reference' => false,
            //     ])
            //     ->setEntryIsComplex(false)
            //     ->setCustomOptions([
            //         'allowAdd' => true,
            //         'allowDelete' => false,
            //         'entryType' => CategoryType::class,
            //         'showEntryLabel' => false,
            //     ])
            // ,
            TextField::new('description', 'Description'),
            TextField::new('allergen', 'Allergènes'),
            TextField::new('traces', 'Traces'),
            CollectionField::new('choices', 'Choix'),
            CollectionField::new('photos', 'Images')->setEntryType(ImageType::class)->onlyOnForms(),
            BooleanField::new('isPublished', 'Publié'),
        ];
    }
}
