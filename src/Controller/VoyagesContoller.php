<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\Routing\Annotation\Route;
/**
 * Description of VoyagesContoller
 *
 * @author Mostaghfera Jan
 */
class VoyagesContoller extends AbstractController {
    #[Route('/voyages', name: 'voyages')]
    public function index(): Response{
        return $this->render ("pages/voyages.html.twig");

    }
}
