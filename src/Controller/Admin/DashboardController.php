<?php

namespace App\Controller\Admin;

use App\Entity\SiteImage;
use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            return $this->render('admin/dashboard.html.twig');
        } else {

            return $this->redirectToRoute('app_decline');
        }
        

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('DuBAin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('SiteImage', 'fas fa-image', SiteImage::class);
        yield MenuItem::linkToCrud('Site', 'fas  fa-location-dot', Site::class);
        yield MenuItem::linkToUrl('Homepage', 'fa fa-home', '/');
    }
}
