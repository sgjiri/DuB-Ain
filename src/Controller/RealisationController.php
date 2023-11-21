<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SiteRepository;

class RealisationController extends AbstractController
{
    #[Route('/realisation', name: 'app_realisation')]
    public function index(SiteRepository $SiteRepository, ImageRepository $imagesRepository): Response
    {
        $sites = $SiteRepository->findAll();
        return $this->render('page/realisation.html.twig', [
            'controller_name' => 'RealisationController','sites' => $sites,
        ]);
    }
}
