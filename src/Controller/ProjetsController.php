<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Service;
use App\Repository\ProjetRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjetsController extends AbstractController
{
    /**
     * @Route("/projets", name="projets")
     */
    public function index(ProjetRepository $projetRepository, ServiceRepository $serviceRepository)
    {
        return $this->render('projets/index.html.twig', [
            'controller_name' => 'ProjetsController',
            'services'=> $serviceRepository->findAll(),
            'projets' => $projetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/projets/{slug}-{id}", name="projets_details", methods= {"GET"})
     * @param Projet $projet
     */
    public function projet_detail(Projet $projet, string $slug, ProjetRepository $projetRepository, ServiceRepository $serviceRepository): Response
    {
        //dd($projet);
        if ($projet->getSlug() !== $slug) {
            return $this->redirectToRoute('projets_details', [
                 'id' => $projet->getId(),
                 'slug' => $projet->getSlug()
             ], 301);
         }  
         return $this->render('projets/projets-details.html.twig', [
             'services'=> $serviceRepository->findAll(),
             'projet' => $projet,
             'projets' => $projetRepository->findAll()
             ]); 
     }
    
}
