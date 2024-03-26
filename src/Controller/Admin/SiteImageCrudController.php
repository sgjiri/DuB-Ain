<?php

namespace App\Controller\Admin;

use App\Entity\SiteImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

/**
 * Le contrôleur CRUD pour l'entité SiteImage dans l'interface administrateur.
 * Hérite de AbstractCrudController pour implémenter les fonctionnalités CRUD pour l'entité SiteImage.
 */
class SiteImageCrudController extends AbstractCrudController
{
    /**
     * Fournit le nom de classe complet de l'entité que ce contrôleur administre.
     * 
     * @return string Le nom de classe complet de l'entité SiteImage.
     */
    public static function getEntityFqcn(): string
    {
        return SiteImage::class;
    }

    /**
     * Configure les champs à utiliser pour les formulaires CRUD générés par EasyAdmin.
     *
     * @param string $pageName Le nom de la page actuelle (utilisé par EasyAdmin pour savoir quel formulaire générer).
     * @return iterable Une liste des champs configurés pour les formulaires CRUD.
     */
    public function configureFields(string $pageName): iterable
    {
        // Les champs sont retournés sous forme de tableau, chaque champ est configuré avec les méthodes chaînées.
        return [
            // Champ 'id', représentant l'identifiant unique de chaque image. Il est caché sur le formulaire pour ne pas être modifié.
            IdField::new('id')->hideOnForm(),
            // Champ 'name', représentant le nom de l'image. Utilise un champ de texte pour la saisie.
            TextField::new('name'),
            // Champ 'room', représentant la pièce où se trouve l'image. Utilise un champ de sélection avec des choix prédéfinis.
            ChoiceField::new('room')->setChoices([
                'Salle de Bain' => 'Salle de Bain',
                'Cuisine' => 'Cuisine',
                'Chambre' => 'Chambre',
                'Salon' => 'Salon',
            ]),
        ];
    }
}