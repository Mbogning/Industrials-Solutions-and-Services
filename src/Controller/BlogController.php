<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ServiceRepository $serviceRepository)
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'services' => $serviceRepository->findAll(),
        ]);
    }
}
