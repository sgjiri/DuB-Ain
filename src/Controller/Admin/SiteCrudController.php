<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Form\ImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

/**
 * Le contrôleur CRUD pour l'entité Site dans l'interface administrateur.
 * Hérite de AbstractCrudController de EasyAdmin pour les fonctionnalités CRUD de base.
 */
class SiteCrudController extends AbstractCrudController
{
    /**
     * Retourne le nom complet de la classe de l'entité que ce CRUD contrôleur gère.
     * 
     * @return string Le nom complet de la classe de l'entité.
     */
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    /**
     * Configure les champs à afficher dans les formulaires CRUD.
     * 
     * @param string $pageName Le nom de la page actuellement affichée.
     * @return iterable Un tableau contenant les champs configurés.
     */
    public function configureFields(string $pageName): iterable
    {
        $images = CollectionField::new('siteImages')
        ->setEntryType(ImageType::class)
        //Si je défini cette option à false, Symfony s'assurera que les méthodes add et remove de mon collection sont bien appelées, ce qui est nécessaire pour la persistance correcte des relations OneToMany et ManyToMany.
        ->setFormTypeOption('by_reference', false)
        //Lorsque cette option est définie sur true, elle permet à l'utilisateur d'ajouter de nouveaux éléments à la collection directement dans le formulaire. 
        ->setFormTypeOption('allow_add', true)
        //Lorsque cette option est définie sur true, elle donne à l'utilisateur la possibilité de supprimer des éléments de la collection directement dans le formulaire. 
        ->setFormTypeOption('allow_delete', true)
        // Si cette option est réglée sur true, elle active la validation de Symfony pour ce champ particulier. Ainsi, les contraintes de validation définies dans les entités seront prises en compte lors de la soumission du formulaire.
        ->setFormTypeOption('validate', true);
        // Utilisation de "yield" pour générer les champs un par un, ce qui peut être plus efficace que de retourner un tableau complet.
        return [
            // Crée un champ 'id' de type IdField, caché dans le formulaire.
            yield IdField::new('id')->hideOnForm(),
            // Crée un champ 'name' de type TextField pour le nom du site.
            yield TextField::new('name'),
            // Crée un champ 'localisation' de type TextField pour la localisation du site.
            yield TextField::new('localisation'),
            // Crée un champ 'description' de type TextEditorField pour éditer la description avec un éditeur de texte riche.
            yield TextEditorField::new('description'),
            // Crée un champ 'surface' de type NumberField pour la surface du site.
            yield NumberField::new('surface'),
            // Crée un champ 'price' de type NumberField pour le prix du site.
            yield NumberField::new('price'),
            // Crée un champ 'duration' de type NumberField pour la durée associée au site.
            yield NumberField::new('duration'),
            // Crée un champ 'siteImages' de type CollectionField pour gérer une collection d'images associées au site.
            // Utilise ImageType comme type de formulaire pour chaque élément de la collection.
            yield CollectionField::new('siteImages')->setEntryType(ImageType::class),
        ];
    }
}