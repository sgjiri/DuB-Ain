<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalleDeBainController extends AbstractController
{
    #[Route('/salledebain', name: 'app_salle_de_bain')]
    public function index(): Response
    {
        return $this->render('page/salledebain.html.twig', [
            'controller_name' => 'SalleDeBainController',
        ]);
    }
}
