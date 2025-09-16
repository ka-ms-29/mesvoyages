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
    
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(VisiteRepository $repository)
    {
        
        $this->repository = $repository;
    }
    /**
     * 
     * @return Response
     */
    #[Route('/voyages', name: 'voyages')]
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render ("pages/voyages.html.twig", [
            'visites' =>$visites
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
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
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
        $valeur = $request->get("recherche");
        $visites = $this->repository->findByEqualValue($champ, $valeur);
        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]);
    } 
    /**
     * phase10_
     * @param type $id
     * @return respnse
     */
    #[Route('/voyages/voyage/{id}', name:'voyages.showone')]
    public function showone($id) : Response{
        $visite = $this->repository->find($id);
        return $this->render("pages/voyage.html.twig",[
            'visite' => $visite
        ]);
    }

    
}


