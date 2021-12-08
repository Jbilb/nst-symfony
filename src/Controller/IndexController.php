<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'PAGE_name' => "accueil",
            'HEADER_title' => "Accueil",
            'META_title' => "accueil du site",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow"
        ]);
    }

    /**
     * @Route("/page2", name="page2")
     */
    public function page2(): Response
    {
        return $this->render('page3.html.twig', [
            'PAGE_name' => "page2",
            'HEADER_title' => "",
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow"
        ]);
    }

    /**
     * @Route("/page3", name="page3")
     */
    public function page3(): Response
    {
        return $this->render('page3.html.twig', [
            'PAGE_name' => "page3",
            'HEADER_title' => "",
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow"
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact.html.twig', [
            'PAGE_name' => "contact",
            'HEADER_title' => "",
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow"
        ]);
    }

    /**
     * @Route("/erreur-404", name="erreur404")
     */
    public function erreur404(): Response
    {
        return $this->render('erreur-404.html.twig', [
            'PAGE_name' => "erreur404",
            'HEADER_title' => "OUPS... Une erreur est survenue.",
            'HEADER_subtitle' => "La page que vous recherchez n'existe plus ou à vraisemblablement été déplacée.",
            'META_title' => "OUPS... Une erreur est survenue.",
            'META_author' => "",
            'META_description' => "La page ou le contenu que vous recherchez n'existe plus ou a été déplacé. Utilisez notre plan de site pour retrouver les informations que vous recherchez",
            'META_robots' => "noindex,nofollow"
        ]);
    }

        /**
     * @Route("/mentions-legales", name="mentions_legales")
     */
    public function legas(): Response
    {
        return $this->render('mentions-legales.html.twig', [
            'PAGE_name' => "legals",
            'HEADER_title' => "MENTIONS<br/> LÉGALES",
            'META_title' => "Mentions légales et politique de confidentialité | NomDuClient",
            'META_author' => "",
            'META_description' => "Les mentions légales relatives à l'utilisation du site www.domaine.ext, ainsi que notre politique de confidentialité à l'égard de vos données personnelles",
            'META_robots' => "noindex,nofollow",
            'LEGALS_client_societe' => "NomDuClient",
            'LEGALS_client_name' => "NOM DU RESPONSABLE DE PUBLICATION",
            'LEGALS_client_role' => "FONCTION DU GERANT",
            'LEGALS_client_statut' => "STATUT DE L'ENTREPRISE",
            'LEGALS_client_capital' => "15 000 €",
            'LEGALS_client_nom_dirigeant' => "NOM DU GERANT",
            'LEGALS_client_rcs' => "RCS de XXX",
            'LEGALS_client_siren' => "XXX XXX XXX",
            'LEGALS_client_siegesocial' => "Adresse + CP + Ville",
            'LEGALS_client_mail'  => "email@domaine.ext",
            'LEGALS_client_tel'  => "XX XX XX XX XX",
            'LEGALS_client_url'  => "www.domaine.ext"
        ]);
    }
}
