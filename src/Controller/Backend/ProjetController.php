<?php

namespace App\Controller\Backend;

use App\Entity\Projet;
use App\Form\ProjetType;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projet")
 */
class ProjetController extends AbstractController
{
    /**
     * @Route("/", name="projet_index", methods={"GET"})
     */
    public function index(ProjetRepository $projetRepository): Response
    {
        return $this->render('backend/projet/index.html.twig', [
            'projets' => $projetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="projet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('projet_index');
        }

        return $this->render('backend/projet/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projet_show", methods={"GET"})
     */
    public function show(Projet $projet): Response
    {
        return $this->render('backend/projet/show.html.twig', [
            'projet' => $projet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="projet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Projet $projet=null): Response
    {
        $projet2=$projet;
        $form = $this->createForm(ProjetType::class, $projet);
        $form->handleRequest($request);

        //dd($projet);
        if($projet) {  
            
            if ($form->isSubmitted() && $form->isValid()) {
                if($projet->getImage()==null) {
                    $projet->setImage($projet2->getImage());
                }
               
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('projet_index');
            }
        }
        return $this->render('backend/projet/edit.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/Image", name="projet_image", methods={"GET","POST"})
     */
    public function image(Request $request, Projet $projet)
    {
        $projet->setImage(null);
        $this->getDoctrine->getManager()->flush();
        return $this->redirectToRoute('projet_edit', array('id' => $projet->getId()));
    }

    /**
     * @Route("/{id}/delete", name="projet_delete", methods={"GET"})
     */
    public function delete(Request $request, Projet $projet=null): Response
    {
        //dd($projet);
        
        if ($projet) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projet_index');
    }
}
