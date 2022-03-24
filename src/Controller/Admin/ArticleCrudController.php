<?php

namespace App\Controller\Admin;

use App\Form\Admin\ArticleFormType;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    // /**
    //  * @Route("/admin/edition-article/", name="edit_article")
    //  */
    // public function editArticle(Request $request, ArticleRepository $articleRepository)
    // {
    //     $id = $request->query->get('id');

    //     $article = $articleRepository->find($id);

    //     return $this->render('admin/article/edit.html.twig', [
    //         'article' => $article
    //     ]);
    // }

    public function new(AdminContext $context)
    {
        file_put_contents('../test.json', 'bonjour-new');

        $article = new Article();
        $page_body = $article->createBody();
        ksort($page_body);

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($context->getRequest());

        if($form->isSubmitted()) {
            file_put_contents('../test2.json', 'bonjour');
        }

        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }

        return $this->render('admin/article/edit.html.twig', [
            'form' => $form->createView(),
            'page_body' => $page_body
        ]);
    }

    public function edit(AdminContext $context)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $context->getEntity()->getInstance();
        $page_body = $article->createBody();
        ksort($page_body);

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($context->getRequest());

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/article/edit.html.twig', [
            'form' => $form->createView(),
            'page_body' => $page_body
        ]);
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     $editLink = Action::new('editLink', 'Editer 2')
    //         ->addCssClass('btn btn-primary')
    //         ->linkToRoute('edit_article', function (Article $entity): array {
    //             return [
    //                 'id' => $entity->getId()
    //             ];
    //         })
    //     ;

    //     return $actions
    //         ->add(Crud::PAGE_INDEX, $editLink)
    //     ;
    // }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('title'),
        ];
    }
}
