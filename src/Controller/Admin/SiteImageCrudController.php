<?php

namespace App\Controller\Admin;

use App\Entity\SiteImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class SiteImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SiteImage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ChoiceField::new('room')->setChoices([
                'Salle de Bain' => 'Salle de Bain',
                'Cuisine' => 'Cuisine',
                'Chambre' => 'Chambre',
                'Salon' => 'Salon',
            ]),
        ];
    }
}
