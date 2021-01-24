<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ServiceRepository $repo): Response
    {
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'services' => $repo->findBy([], [], 3)
        ]);
    }

   
}
