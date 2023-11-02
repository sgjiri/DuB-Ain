<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeclineController extends AbstractController
{
    #[Route('/decline', name: 'app_decline')]
    public function index(): Response
    {
        return $this->render('page/decline.html.twig', [
            'controller_name' => 'DeclineController',
        ]);
    }
}
