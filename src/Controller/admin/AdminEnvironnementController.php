<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

use App\Entity\Environnement;
use App\Repository\EnvironnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




/**
 * Description of AdminEnvironnementController
 *
 * @author Mostaghfera Jan
 */
class AdminEnvironnementController extends AbstractController{
    
    /**
     * 
     * @var type
     */
    private $repository;
    
    /**
     * 
     * @param VisiteRepository $repository
     */
    public function __construct(EnvironnementRepository $repository)
    {
        
        $this->repository = $repository;
    }
    /**
     * 
     * @return Response
     */
    #[Route('/admin/environnements', name: 'admin.environnements')]
    public function index(): Response{
        $environnements = $this->repository->findAll();
        return $this->render ("admin/admin.environnements.html.twig", [
            'environnements' =>$environnements
        ]);
    }
    /**
     * 
     * @param int $id
     * @return Response
     */
    #[Route('/admin/environnement/suppr/{id}', name: 'admin.environnement.suppr')]
    public function suppr(int $id): Response{
        $environnement = $this->repository->find($id);
        $this->repository->remove($environnement);
        return $this->redirectToRoute('admin.environnements');
    }
    /**
     * 
     * @param Request $request
     * @return Response
     */
    #[Route('/admin/environnement/ajout', name: 'admin.environnement.ajout')]
    public function ajout(Request $request): Response{
        $nomEnvironnement = $request->get("nom");
        $environnement = new Environnement();
        $environnement->setNom($nomEnvironnement);
        $this->repository->add($environnement);
        return $this->redirectToRoute('admin.environnements');
    }
}
