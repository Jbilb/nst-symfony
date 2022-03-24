<?php

namespace App\Controller\Admin;

use App\Entity\FaqQuestion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FaqQuestionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FaqQuestion::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index','Foire aux question')
            ->setPageTitle('edit','Editer une question')
            ->setPageTitle('new', 'Ajouter une question')
            ->setPaginatorPageSize(10)
            // ->setDefaultSort(['createdAt' => 'DESC'])
            ->renderContentMaximized()
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter une question');
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
            FormField::addPanel()->setCssClass('col-sm-6'),
            TextField::new('title', 'Question'),
            TextEditorField::new('description', 'Réponse'),
            FormField::addPanel()->setCssClass('col-sm-6'),
            BooleanField::new('isPublished', 'Publier la question'),
        ];
    }

}
