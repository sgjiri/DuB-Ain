<?php

namespace App\Form;

use App\Entity\SiteImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('file', VichImageType::class, [
            'label' => 'Image',
            'constraints' => [
                new File([
                    'maxSize' => '500K',
                    'maxSizeMessage' => 'Le fichier est trop grand. Veuillez choisir un fichier de taille inférieure à 500K.',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                    ],
                    'mimeTypesMessage' => 'Veuillez sélectionner une image au format JPEG, PNG ou GIF.', 
                ]),
            ],
        ])
            ->add('room', ChoiceType::class, [
                'label' => 'Room',
                'choices' => [
                    'Salle de Bain' => 'Salle de Bain',
                    'Cuisine' => 'Cuisine',
                    'Chambre' => 'Chambre',
                    'Salon' => 'Salon',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SiteImage::class,
        ]);
    }
}
