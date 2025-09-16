<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;
use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Annotation\Route;
/**
 * Description of AdminVoyagesController
 *
 * @author Mostaghfera Jan
 */
class AdminVoyagesController extends AbstractController {
    /**
     * 
     * @var type
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
    #[Route('/admin', name: 'admin.voyages')]
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render ("admin/admin.voyages.html.twig", [
            'visites' =>$visites
        ]);
    }
    /**
     * 
     * @param int $id
     * @return Response
     */
    #[Route('/admin/suppr/{id}', name: 'admin.voyage.suppr')]
    public function suppr(int $id): Response{
        $visite = $this->repository->find($id);
        $this->repository->remove($visite);
        return $this->redirectToRoute('admin.voyages');
    }
}
