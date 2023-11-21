<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SiteImageRepository;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page')]
    public function index(SiteImageRepository $imagesRepository): Response
    {
        $images = $imagesRepository->findAll();
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController', 'images' => $images
        ]);
    }
}
