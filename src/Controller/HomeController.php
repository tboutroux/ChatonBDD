<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $doctrine): Response
    {

        $categories = $doctrine->getRepository(Categorie::class)->findAll();

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    public function menu(EntityManagerInterface $doctrine): Response
    {

        $categories = $doctrine->getRepository(Categorie::class)->findAll();

        return $this->render('home/_menu.html.twig', [
            'categories' => $categories,
        ]);
    }
}
