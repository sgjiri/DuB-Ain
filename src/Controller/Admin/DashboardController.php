<?php

namespace App\Controller\Admin;
use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            return $this->redirect($adminUrlGenerator->setController(SiteCrudController::class));
        } else {
            return $this->redirectToRoute('app_decline');
        }
    }
    
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Site', 'fas  fa-location-dot', Site::class);
        yield MenuItem::linkToUrl('Homepage', 'fa fa-home', '/');
    }
}
