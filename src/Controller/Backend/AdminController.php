<?php

namespace App\Controller\Backend;

/*use App\Entity\Eleve;
use App\Entity\Tranche;
use App\Entity\Inscription;
use App\Entity\Pansion;
use App\Repository\AcheterRepository;
use App\Repository\AnneeRepository;
use App\Repository\EleveRepository;
use App\Repository\DepenseRepository;
use App\Repository\TrancheRepository;*/
/*use App\Repository\NewsActualiteRepository;
use App\Repository\PlayArtisteRepository;
use App\Repository\PlayTopSingleRepository;
use App\Repository\PlayTopVideoRepository;
use App\Repository\PlaySingleRepository;
use App\Repository\PlayVideoRepository;
use App\Repository\PlayAlbumRepository;*/
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/admin")
*/
class AdminController extends AbstractController
{
    // page d'accueil
    /**
     * @Route("", name="dashboard", methods={"GET"})
     */
    public function index(): Response
    {
        
        return $this->render('backend/accueil.html.twig', [
            
        ]);  
    }
    
      
    // page d'accueil
    /**
     * @Route("/", name="accueil", methods={"GET","POST"})
     */
    public function accueil()
    {      
        $em = $this->getDoctrine()->getManager();
            
        return $this->render('home/index.html.twig');                    
        
    }
    
}
