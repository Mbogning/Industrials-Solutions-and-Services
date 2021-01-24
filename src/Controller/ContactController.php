<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(ServiceRepository $serviceRepository)
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'services' => $serviceRepository->findAll(),
        ]);
    }
}
