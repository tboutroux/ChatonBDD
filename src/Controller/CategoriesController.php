<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $repo = $doctrine->getRepository(Categorie::class);
        $categories = $repo->findAll();

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    //action pour ajouter une categorie
    #[Route('/categories/ajouter', name: 'app_categories_ajouter')]
    public function ajouter(Request $request, ManagerRegistry $doctrine): Response
    {
        //créer un formulaire
        //on crée un objet de la classe Categorie
        $categorie = new Categorie();
        //on crée un formulaire
        $form = $this->createForm(CategorieType::class, $categorie);

        //todo : traiter le formulaire en retour
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère le manager de doctrine
            $em = $doctrine->getManager();
            //on demande au manager de sauvegarder l'objet
            $em->persist($categorie);
            //on exécute la requête
            $em->flush();

            //on redirige vers la liste des catégories
            return $this->redirectToRoute('app_categories');
        }

        return $this->render('categories/ajouter.html.twig', [
            "formulaire"=>$form->createView(),
            ]);
    }

    #[Route('/categories/modifier/{id}', name: 'app_categories_modifier')]
    public function modifier($id, Request $request, ManagerRegistry $doctrine): Response
    {
        //créer un formulaire
        //on crée un objet de la classe Categorie
        $repo = $doctrine->getRepository(Categorie::class);
        $categorie = $repo->find($id);
        //on crée un formulaire
        $form = $this->createForm(CategorieType::class, $categorie);

        //todo : traiter le formulaire en retour
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère le manager de doctrine
            $em = $doctrine->getManager();
            //on demande au manager de sauvegarder l'objet
            $em->persist($categorie);
            //on exécute la requête
            $em->flush();

            //on redirige vers la liste des catégories
            return $this->redirectToRoute('app_categories');
        }

        return $this->render('categories/ajouter.html.twig', [
            "formulaire"=>$form->createView(),
            ]);
    }
}