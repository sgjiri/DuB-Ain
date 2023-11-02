<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RealisationController extends AbstractController
{
    #[Route('/realisation', name: 'app_realisation')]
    public function index(): Response
    {
        return $this->render('page/realisation.html.twig', [
            'controller_name' => 'RealisationController',
        ]);
    }
}
