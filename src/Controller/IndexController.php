<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Restaurant;
use App\Form\ApplicationType;
use App\Form\ContactType;
use App\Form\DocumentationType;
use App\Repository\FaqQuestionRepository;
use App\Repository\OfferRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(Request $request, RestaurantRepository $restaurantRepo, OfferRepository $offerRepo): Response
    {
        $idRestaurant = $request->cookies->get('favorite-restaurant');
        $restaurant = $restaurantRepo->findOneBy(['id' => $idRestaurant]);
        $offers = $offerRepo->findPublished();

        return $this->render('index.html.twig', [
            'PAGE_name' => "accueil",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
            // Variables utiles
            'restaurant' => $restaurant,
            'offers' => $offers,
        ]);
    }

    /**
     * @Route("/offre/{id}", name="offre")
     * Proto: Page type offre permanente
     */
    public function offre(Request $request, Offer $offer): Response
    {
        return $this->render('offre.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
            // Variables utiles
            'offer' => $offer,
        ]);
    }

    /**
     * @Route("/trouve-ton-restaurant", name="trouve_restaurant")
     * Proto: Trouve ton restaurant
     */
    public function trouveRestaurant(Request $request, RestaurantRepository $restaurantRepo): Response
    {
        $restaurants = $restaurantRepo->findPublished();

        return $this->render('trouve-restaurant.html.twig', [
            'PAGE_name' => "trouve-restaurant",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
            // Variables utiles
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * @Route("/restaurant/{id}", name="restaurant")
     * Proto: Page type restaurant
     */
    public function restaurant(Request $request, Restaurant $restaurant): Response
    {
        return $this->render('restaurant.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
            // Variables utiles
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * @Route("/presse", name="presse")
     * Proto: Page presse
     */
    public function presse(Request $request): Response
    {
        return $this->render('presse.html.twig', [
            'PAGE_name' => "presse",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/faq", name="faq")
     * Proto: FAQ
     */
    public function faq(Request $request, FaqQuestionRepository $faqQuestionRepo, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = (new TemplatedEmail())
                ->from($data['email'])
                ->to('adresse@mailduclient.com')
                ->subject('Formulaire de contact - Mail reçu depuis votre site web')
                ->htmlTemplate('emails/formulaire-contact.html.twig')
                ->context([
                    'courriel' => $data['email'],
                    'name' => $data['name'],
                    'message' => $data['message']
                ])
            ;
            
            $mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé avec succès');

            return $this->redirectToRoute('faq');  
        }

        $faqQuestions = $faqQuestionRepo->findPublished();

        return $this->render('faq.html.twig', [
            'form' => $form->createView(),
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
            // Variables utiles
            'faqQuestions' => $faqQuestions
        ]);
    }

    /**
     * @Route("/menu", name="carte_menu")
     * Proto: La Carte
     */
    public function carteMenu(Request $request): Response
    {
        return $this->render('carte-menu.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/categorie", name="carte_categorie")
     * Proto: La Carte - 1
     */
    public function carteCategorie(Request $request): Response
    {
        return $this->render('carte-categorie.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/produit", name="carte_produit")
     * Proto: Page template produit - Le chef
     */
    public function carteProduit(Request $request): Response
    {
        return $this->render('carte-produit.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/tacos-a-compsoser", name="carte_tacos_composer")
     * Proto: Page template tacos à composer
     */
    public function carteTacosComposer(Request $request): Response
    {
        return $this->render('carte-tacos-composer.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     * Proto: Story - Présentation de New School Tacos
     */
    public function presentation(Request $request): Response
    {
        return $this->render('presentation.html.twig', [
            'PAGE_name' => "presentation",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/rejoindre-les-equipes", name="rejoindre_equipes")
     * Proto: Rejoindre les équipes
     */
    public function rejoindreEquipe(Request $request): Response
    {
        return $this->render('rejoindre-equipes.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/equipier-cuisine", name="equipier_cuisine")
     * Proto: Métier Equipier Cuisine
     */
    public function equipierCuisine(Request $request, MailerInterface $mailer, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ApplicationType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            /** @var UploadedFile $file */
            $file = $data['file'];

            if($file) {
                $originFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('file_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    //
                }
            }

            $message = (new TemplatedEmail())
                ->from($data['email'])
                ->to('adresse@mailduclient.com')
                ->subject('Formulaire "Rejoindre la franchise" - Mail reçu depuis votre site web')
                ->htmlTemplate('emails/formulaire-candidature.html.twig')
                ->context([
                    'courriel' => $data['email'],
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'restaurant' => $data['restaurant']->getName(),
                    'job' => $data['job'],
                    'message' => $data['message'],
                    'file' => $data['file']
                ])
                ->attachFromPath('uploads/files/'.$newFilename)
            ;
            
            $mailer->send($message);

            $this->addFlash('success', 'Votre demande d\'implantation a été envoyée avec succès');

            return $this->redirectToRoute('rejoindre_franchise');  
            // return new BinaryFileResponse('../docs/documentation-lorem.pdf');
        }

        return $this->render('equipier-cuisine.html.twig', [
            'form' => $form->createView(),
            'PAGE_name' => "equipier-cuisine",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/rejoindre-la-franchise", name="rejoindre_franchise")
     * Proto: Rejoindre la franchise
     */
    public function rejoindreFranchise(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(DocumentationType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = (new TemplatedEmail())
                ->from($data['email'])
                ->to('adresse@mailduclient.com')
                ->subject('Formulaire "Rejoindre la franchise" - Mail reçu depuis votre site web')
                ->htmlTemplate('emails/formulaire-demande-implantation.html.twig')
                ->context([
                    'courriel' => $data['email'],
                    'name' => $data['name'],
                    'ville' => $data['city']
                ])
            ;
            
            $mailer->send($message);

            $this->addFlash('success', 'Votre demande d\'implantation a été envoyée avec succès');

            return $this->redirectToRoute('rejoindre_franchise');  
            // return new BinaryFileResponse('../docs/documentation-lorem.pdf');
        }

        return $this->render('rejoindre-franchise.html.twig', [
            'form' => $form->createView(),
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/marque-employeur", name="marque_employeur")
     * Proto: Page marque employeur accueil
     */
    public function marqueEmployeur(Request $request): Response
    {
        return $this->render('marque-employeur.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/le-magazine", name="magazine")
     * Proto: Magazine
     */
    public function magazine(Request $request): Response
    {
        return $this->render('magazine.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }

    /**
     * @Route("/article", name="article")
     * Proto: Article
     */
    public function article(Request $request): Response
    {
        return $this->render('article.html.twig', [
            'PAGE_name' => "offre",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
        ]);
    }



    /**
     * @Route("/contact", name="contact")
     * Proto: Page contact cachée
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = (new TemplatedEmail())
                ->from($data['email'])
                ->to('adresse@mailduclient.com')
                ->subject('Formulaire de contact - Mail reçu depuis votre site web')
                ->htmlTemplate('emails/formulaire-contact.html.twig')
                ->context([
                    'courriel' => $data['email'],
                    'name' => $data['name'],
                    'message' => $data['message']
                ])
            ;
            
            $mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé avec succès');

            return $this->redirectToRoute('faq');  
        }

        return $this->render('contact-hidden.html.twig', [
            'form' => $form->createView(),
            'PAGE_name' => "contact",
            // Variables des titres
            'HEADER_title' => "",
            'HEADER_subtitle' => "",
            // META 
            'META_title' => "",
            'META_author' => "",
            'META_description' => "",
            'META_robots' => "index,follow",
            'ogURL' => $request->getUri(),
            // Type de header
            'HEADER_type' => "",
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
    public function legal(): Response
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

    // /**
    //  * @Route("/test-cookie/{id}", name="test_cookie")
    //  */
    // public function addFavoriteRestaurant(Request $request, Restaurant $restaurant)
    // {
    //     $response = new Response();
    //     $response->headers->setCookie(Cookie::create('favorite-restaurant', $restaurant->getId()));
    //     $response->send();

    //     return $this->redirectToRoute('restaurant', ['id' => $restaurant->getId()]);
    // }
}
