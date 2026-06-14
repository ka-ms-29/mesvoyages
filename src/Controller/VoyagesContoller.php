<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Annotation\Route;
use App\Repository\EnvironnementRepository;




/**
 * Description of VoyagesContoller
 *
 * @author Mostaghfera Jan
 */
class VoyagesContoller extends AbstractController {
    
    /**
     * @var VisiteRepository
     */
    private $repository;
    
    private $environnementRepository;

    
    const PAGEVOYAGES = "pages/voyages.html.twig";
    const PAGEVOYAGE = "pages/voyage.html.twig";
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository, EnvironnementRepository $environnementRepository)
    {
        $this->repository = $repository;
        $this->environnementRepository = $environnementRepository;
    }
    /**
     * 
     * @return Response
     */
    #[Route('/voyages', name: 'voyages')]
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        $environnements = $this->environnementRepository->findAll();
        return $this->render (self::PAGEVOYAGES, [
            'visites' =>$visites,
            'environnements' => $environnements
        ]);
    }
    /**
     * 
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    #[Route('/voyages/tri/{champ}/{ordre}', name: 'voyages.sort')]
    public function sort($champ, $ordre): Response{
        $visites = $this->repository->findAllOrderBy($champ, $ordre);
        $environnements = $this->environnementRepository->findAll();
        return $this->render(self::PAGEVOYAGES, [
            'visites' => $visites,
            'environnements' => $environnements
        ]);
    }
    
    /**
     * phase9_
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    #[Route('/voyages/recherche/{champ}', name: 'voyages.findallequal')]
    public function findAllEqual($champ, Request $request): Response{
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
            $visites = $this->repository->findByEqualValue($champ, $valeur);
            $environnements = $this->environnementRepository->findAll();
            return $this->render(self::PAGEVOYAGES, [
                'visites' => $visites,
                'environnements' => $environnements
            ]);
        }
        return $this->redirectToRoute("voyages");
    } 
   
    #[Route('/voyages/recherche/{champ}', name: 'voyages.findallenvironnement')]
    public function findAllForOneEnvironnement ($champ, Request $request) : Response{
            
        $valeur = $request->get("recherche");
            
        $visites = $this->repository->findAllForOneEnvironnement($valeur);
            
        $environnements = $this->environnementRepository->findAll();
            return $this->render(self::PAGEVOYAGES, [
                'visites' => $visites,
                'environnements' => $environnements
            ]);
            return $this->redirectToRoute("voyages");
    }
    
    /**
    #[Route('/formations/recherche/{champ}/{table}', name: 'formations.findallcontain')]
    public function findAllContain($champ, Request $request, $table=""): Response{
        $valeur = $request->get("recherche");
        $formations = $this->formationRepository->findByContainValue($champ, $valeur, $table);
        $categories = $this->categorieRepository->findAll();
        return $this->render(self::PAGEFORMATIONS, [
            'formations' => $formations,
            'categories' => $categories,
            'valeur' => $valeur,
            'table' => $table
        ]);
    }  
    */
    
    /**
     * phase10_
     * @param type $id
     * @return respnse
     */
    #[Route('/voyages/voyage/{id}', name:'voyages.showone')]
    public function showone($id) : Response{
        $visite = $this->repository->find($id);
        return $this->render(self::PAGEVOYAGE,[
            'visite' => $visite
        ]);
    }

    
}


