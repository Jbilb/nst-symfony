<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\FaqQuestion;
use App\Entity\Offer;
use App\Entity\Product;
use App\Entity\Restaurant;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('New School Tacos - Zone d\'administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Produits', 'fa fa-burrito', Product::class);
        yield MenuItem::linkToCrud('Catégorie de produit', 'fa fa-product', Category::class);
        yield MenuItem::linkToCrud('Offres', 'fa fa-bolt-lightning', Offer::class);
        yield MenuItem::linkToCrud('Restaurants', 'fa fa-fork-knife', Restaurant::class);
        yield MenuItem::linkToCrud('F.A.Q.', 'fa fa-comment-question', FaqQuestion::class);
        yield MenuItem::linkToCrud('Articles', 'fas fa-users', Article::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToLogout('Se déconnecter', 'fa fa-sign-out');
    }
}
