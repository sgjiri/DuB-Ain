<?php

namespace App\Form;

use App\Entity\SiteImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;

/**
 * Classe qui définit le formulaire pour les images d'un site.
 * Elle étend AbstractType qui est la classe de base pour la création de formulaire dans Symfony.
 */
class ImageType extends AbstractType
{
    /**
     * Construit le formulaire pour les images avec les champs nécessaires.
     *
     * @param FormBuilderInterface $builder L'interface du constructeur de formulaire.
     * @param array $options Un tableau d'options pour le formulaire.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Ajoute un champ 'file' de type VichImageType au formulaire pour le téléchargement de l'image.
        $builder->add('file', VichImageType::class, [
            // Le label qui sera affiché à côté du champ 'file'.
            'label' => 'Image',
            // Définit les contraintes de validation pour le fichier image.
            'constraints' => [
                new File([
                    // La taille maximale autorisée pour le fichier.
                    'maxSize' => '500K',
                    // Le message d'erreur si le fichier dépasse la taille maximale.
                    'maxSizeMessage' => 'Le fichier est trop grand. Veuillez choisir un fichier de taille inférieure à 500K.',
                    // Les types MIME autorisés pour le fichier.
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                        'image/webp',
                    ],
                    // Le message d'erreur si le type MIME du fichier n'est pas autorisé.
                    'mimeTypesMessage' => 'Veuillez sélectionner une image au format JPEG, PNG, WEBP ou GIF.', 
                ]),
            ],
        ])
        // Ajoute un champ 'room' de type ChoiceType au formulaire pour sélectionner une pièce.
        ->add('room', ChoiceType::class, [
            // Le label qui sera affiché à côté du champ 'room'.
            'label' => 'Room',
            // Les choix disponibles pour le champ 'room'.
            'choices' => [
                'Salle de Bain' => 'Salle de Bain',
                'Cuisine' => 'Cuisine',
                'Chambre' => 'Chambre',
                'Salon' => 'Salon',
            ],
        ]);
    }

    /**
     * Configure les options pour ce type de formulaire.
     *
     * @param OptionsResolver $resolver L'instance de résolution d'options.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        // Définit les options par défaut pour ce type de formulaire.
        $resolver->setDefaults([
            // Associe ce formulaire à l'entité SiteImage, ce qui permet au formulaire de sauvegarder directement les données dans une instance de SiteImage.
            'data_class' => SiteImage::class,
        ]);
    }
}