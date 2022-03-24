<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use App\Form\ImageRestaurantType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ->overrideTemplate('crud/field/text', 'admin/templates/test.html.twig')
            ->setPageTitle('index','Liste des restaurants New School Tacos')
            ->setPageTitle('edit','Editer un restaurant')
            ->setPageTitle('new', 'Ajouter un restaurant')
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
                return $action->setLabel('Ajouter un restaurant');
            })
            ->add(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setLabel('voir');
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
            // Informations générales
            FormField::addTab('Informations générales'),
            FormField::addPanel('Informations pratiques')->setCssClass('col-sm-6'),
            TextField::new('name', 'Nom du restaurant'),
            TextField::new('phone', 'Numéro de téléphone'),
            TextField::new('email', 'Adresse email'),
            TextField::new('address', 'Adresse'),
            HiddenField::new('lat', 'Latitude')->onlyOnForms(),
            HiddenField::new('lng', 'Longitude')->onlyOnForms(),
            // Informations secondaires
            FormField::addPanel('Page du restaurant')->setCssClass('col-sm-6'),
            DateField::new('datePublishing', 'Date de publication du restaurant')->onlyOnForms(),
            BooleanField::new('isPublished', 'Publié'),
            TextField::new('titleContent', 'Titre de la page')->onlyOnForms(),
            TextField::new('buttonTitle', 'Texte du bouton')->onlyOnForms(),
            TextEditorField::new('textContent', 'Description du restaurant')->onlyOnForms(),
            // Horaires d'ouverture
            FormField::addPanel('Horaire d\'ouverture')->setCssClass('col-sm-6'),
            TextField::new('timeMonday', 'Lundi'),
            TextField::new('timeTuesday', 'Mardi'),
            TextField::new('timeWenesday', 'Mercredi'),
            TextField::new('timeThursday', 'Jeudi'),
            TextField::new('timeFriday', 'Vendredi'),
            TextField::new('timeSaturday', 'Samedi'),
            TextField::new('timeSunday', 'Dimanche'),
            // Images
            FormField::addTab('Images'),
            FormField::addPanel()->setCssClass('col-sm-6'),
            CollectionField::new('imageRestaurants', 'Galerie photos')->setEntryType(ImageRestaurantType::class)->onlyOnForms(),
            // Liens
            FormField::addTab('Liens'),
            FormField::addPanel('Liens')->setCssClass('col-sm-6'),
            UrlField::new('urlOrder', 'URL de l\'offre')->onlyOnForms(),
            TextField::new('urlGoogle', 'URL avis Google')->onlyOnForms(),
            TextField::new('urlItinary', 'URL d\'itinéraire')->onlyOnForms(),
            TextField::new('urlYoutube', 'URL vidéo YouTube')->onlyOnForms(),
            TextField::new('urlSymbiose', 'URL Symbiose')->onlyOnForms(),
        ];
    }
}
