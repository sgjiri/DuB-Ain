<?php

// Définir l'espace de noms pour la classe de formulaire
namespace App\Form;

// Importer les composants nécessaires de Symfony
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints as Assert;

// Créer une classe de type de formulaire personnalisée pour un formulaire de contact
class ContactType extends AbstractType
{
    // Construire le formulaire avec les champs et les contraintes de validation
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Commencer à construire le formulaire
        $builder
            // Ajouter un champ 'Nom' avec des contraintes de validation
            ->add('Nom', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 50]),
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre nom',
                ],
            ])
            // Ajouter un champ 'Prenom' avec des contraintes de validation
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
            // Ajouter un champ 'email' avec des contraintes de validation spécifiques aux e-mails
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
            // Ajouter un champ 'Telephone' avec des contraintes de validation pour le format
            // Ajouter un champ 'Telephone' avec des contraintes de validation pour le format
            ->add('Telephone', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le numéro de téléphone est obligatoire.',
                    ]),
                    new Assert\Length([
                        'min' => 10,
                        'max' => 10,
                        'exactMessage' => 'Le numéro de téléphone doit comporter exactement 10 chiffres.',
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[0-9]*$/',
                        'message' => 'Le numéro de téléphone ne peut contenir que des chiffres.',
                    ]),
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre numéro de téléphone',
                    
                ],
                'error_bubbling' => false,
            ])
            // Ajouter un champ 'Object' pour l'objet du message
            ->add('Object', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 50]),
                ],
                'required' => true,
                'attr' => [
                    'placeholder' => 'L\'objet de votre message',
                ],
            ])
            // Ajouter un champ 'Message' pour le contenu du message avec une longueur maximale
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
            // Ajouter un bouton de soumission pour envoyer le formulaire
            ->add('Envoyer', SubmitType::class)
            // Ajouter un champ 'honeypot' comme mesure anti-spam (non mappé et caché)
            ->add('honeypot', TextType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => ['style' => 'display:none;']
            ]);
    }

    // Configurer les options par défaut pour le formulaire, y compris la protection CSRF
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true, // Activer la protection CSRF
            'csrf_field_name' => '_token', // NomDu code pour le formulaire de contact en PHP en utilisant Symfony.
            // Vous pouvez également définir un 'csrf_token_id' unique pour ce formulaire si nécessaire
        ]);
    }
}
