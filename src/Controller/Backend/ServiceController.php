<?php

namespace App\Controller\Backend;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service_index", methods={"GET"})
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('backend/service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="service_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            $this->addFlash('success', 'Le service a bien été crée');
            return $this->redirectToRoute('service_index');
        }

        return $this->render('backend/service/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="service_show", methods={"GET"})
     */
    public function show(Service $service): Response
    {
        return $this->render('backend/service/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="service_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Service $service): Response
    {
        $service2 = $service;
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

       
            if ($form->isSubmitted() && $form->isValid()) {
                if($service->getImage()==null) {
                    $service->setImage($service2->getImage());
                }
                $this->getDoctrine()->getManager()->flush();

                $this->addFlash('success', 'Le service a bien été crée');
    
                return $this->redirectToRoute('service_index');
            }

        
        return $this->render('backend/service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/Image", name="service_image", methods={"GET","POST"})
     */
    public function image(Request $request, Service $service)
    {
        $service->setImage(null);
        $this->getDoctrine->getManager()->flush();
        return $this->redirectToRoute('service_edit', array('id' => $service->getId()));
    }


    /**
     * @Route("/{id}/delete", name="service_delete", methods={"GET"})
     */
    public function delete(Request $request, Service $service=null): Response
    {
        if ($service) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('service_index');
    }
}
