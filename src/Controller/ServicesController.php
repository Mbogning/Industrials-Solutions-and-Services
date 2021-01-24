<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    /**
     * @Route("/services", name="services")
     */
    public function index( ServiceRepository $serviceRepository): Response
    {
        return $this->render('services/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/services/{slug}-{id}", name="services_details", methods= {"GET"})
     * @param Service $service
     */
    public function service_detail(Service $service, string $slug, ServiceRepository $serviceRepository):Response
    {
        //dd($service);
        if ($service->getSlug() !== $slug) {
           return $this->redirectToRoute('services_details', [
                'id' => $service->getId(),
                'slug' => $service->getSlug()
            ], 301);
        }  
        return $this->render('services/services-details.html.twig', [
            'service' => $service,
            'services' => $serviceRepository->findAll()
            ]); 
    }
    
}
