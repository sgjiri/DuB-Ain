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
                new
                Assert\NotBlank([
                    'message' => 'Votre nom est obligatoire.',
                ]),
                new Assert\Length([
                    'min' => 2, 
                    'max' => 50,
                    'minMessage' => 'Votre nom doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Votre nom ne peut pas dépasser {{ limit }} caractères.'                               
                ]),
            ],
            'required' => true, 
            'attr' => [
                'placeholder' => 'Votre nom',
            ],
        ])
        ->add('Prenom', TextType::class, [
            'constraints' => [
                new
                Assert\NotBlank([
                    'message' => 'Votre prenom est obligatoire.',
                ]),
                new Assert\Length([
                    'min' => 2, 
                    'max' => 50,
                    'minMessage' => 'Votre prénom doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Votre prénom ne peut pas dépasser {{ limit }} caractères.'                       
                ]),
            ],
            'required' => true, 
            'attr' => [
                'placeholder' => 'Votre prénom',
            ],
        ])
        ->add('email', EmailType::class, [
             'constraints' => [
                new
                Assert\NotBlank([
                    'message' => 'Votre email est obligatoire.',
                ]),
                new Assert\Email([
                    'message' => 'L\'email n\'est pas valide.'
                ]),
                new Assert\Length([
                    'min' => 5,
                    'max' => 200,
                    'minMessage' => 'Le message doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le message ne peut pas dépasser {{ limit }} caractères.',

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
                new
                Assert\NotBlank([
                    'message' => 'Objet de message est obligatoire.',
                ]),
                new Assert\Length([
                    'min' => 2, 
                    'max' => 50,
                    'minMessage' => 'Objet de message doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Objet de message ne peut pas dépasser {{ limit }} caractères.'  
                
                ]),
            ],
            'required' => true,
            'attr' => [
                'placeholder' => 'Votre prénom',
            ],
        ])
        ->add('Message', TextareaType::class, [
            'constraints' => [
                new
                Assert\NotBlank([
                    'message' => 'Message est obligatoire.',
                ]),
                new Assert\Length([
                    'min' => 15, 
                    'max' => 1000,
                    'minMessage' => 'Le message doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le message ne peut pas dépasser {{ limit }} caractères.',
                
                ]),
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
