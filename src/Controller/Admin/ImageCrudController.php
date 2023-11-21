<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\File;

class ImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Images')
        ->setEntityLabelInSingular('Image');
    }

    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id')
            ->hideOnForm(),
        TextField::new('thumbnail'),
        ChoiceField::new('room')->setChoices([
            'Salle de Bain' => 'Salle de Bain',
            'Cuisine' => 'Cuisine',
            'Chambre' => 'Chambre',
            'Salon' => 'Salon',
        ]),
        TextField::new('attachmentFile')->setFormType(VichImageType::class, [
            'constraints' => [
                new File([
                    'maxSize' => '500k',
                    'maxSizeMessage' => 'Le fichier ne peut pas dépasser 500 Ko.',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                    ],
                    'mimeTypesMessage' => 'Seuls les fichiers JPEG, PNG et GIF sont autorisés.',
                ]),
            ],
        ]),
        ImageField::new('attachment')->setBasePath('/uploads/attachment')->onlyOnIndex(),
    ];
}
    
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::deleteEntity($entityManager, $entityInstance);
        
        // Supprimez l'image du système de fichiers ou effectuez toute autre opération de suppression nécessaire
        // Notez que vous devrez utiliser le chemin de fichier stocké dans le champ 'attachment' de l'entité Image pour supprimer le fichier correspondant.
    }
}