<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Nom', TextType::class,[
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50]),
            ],
            'required' => true, 
            'attr' => [
                'placeholder' => 'Votre nom',
            ],
        ])
        ->add('Prenom', TextType::class, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50]),
            ],
            'required' => true, 
            'attr' => [
                'placeholder' => 'Votre prénom',
            ],
        ])
        ->add('email', EmailType::class, [
             'constraints' => [
                new Assert\NotBlank(),
                new Assert\Email([
                    'message' => 'L\'email n\'est pas valide.'
                ]),
            ],
            'required' => true,
            'attr' => [
                'placeholder' => 'Votre email',
            ],
        ])
        ->add('Telephone', TextType::class, [
            'constraints' => [
                new Assert\NotBlank([
                    'message' => 'Le numéro de téléphone est obligatoire.',
                ]),
                new Assert\Length([
                    'min' => 10,
                    'max' => 15,
                    'minMessage' => 'Le numéro de téléphone doit comporter au moins {{ limit }} chiffres.',
                    'maxMessage' => 'Le numéro de téléphone ne peut pas dépasser {{ limit }} chiffres.',
                ]),
                new Assert\Regex([
                    'pattern' => '/^[0-9\-\(\)\/\+\s]*$/',
                    'message' => 'Le numéro de téléphone n\'est pas valide.',
                ]),
            ],
            'required' => true,
            'attr' => [
                'placeholder' => 'Votre numéro de téléphone',
            ],
        ])
        ->add('Object', TextType::class, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50]),
            ],
            'required' => true,
            'attr' => [
                'placeholder' => 'Votre prénom',
            ],
        ])
        ->add('Message', TextareaType::class, [
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 1000]),
            ],
            'required' => true,
            'attr' => [
                'placeholder' => 'Votre message',
            ],
        ])
        ->add('Envoyer', SubmitType::class)
        ->add('honeypot', TextType::class, [
            'mapped' => false,
            'required' => false,
            'attr' => ['style' => 'display:none;']
        ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
{
    $resolver->setDefaults([
        'csrf_protection' => true,
        'csrf_field_name' => '_token',
        // Vous pouvez également définir un 'csrf_token_id' unique pour ce formulaire si nécessaire
    ]);
}
    
}
