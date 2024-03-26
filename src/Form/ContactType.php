<?php

// Déclaration de l'espace de nommage du formulaire
namespace App\Form;

// Importation des classes nécessaires à la création du formulaire
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Classe définissant le formulaire de contact.
 */
class ContactType extends AbstractType
{
    /**
     * Construit les éléments du formulaire de contact.
     *
     * @param FormBuilderInterface $builder Le constructeur de formulaire.
     * @param array $options Les options pour ce formulaire.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Ajout d'un champ de texte pour entrer le nom de l'utilisateur
        $builder->add('nom', TextType::class, [
            'constraints' => [
                // Contrainte pour s'assurer que le champ n'est pas vide
                new Assert\NotBlank([
                    'message' => 'Votre nom est obligatoire.',
                ]),
                // Contrainte pour limiter la longueur du nom
                new Assert\Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Votre nom doit comporter au moins {{ limit }} caractères.',
                    'maxMessage' => 'Votre nom ne peut pas dépasser {{ limit }} caractères.'
                ]),
            ],
            'required' => true,
            'attr' => [
                'placeholder' => 'Votre nom', // Texte indicatif dans le champ
            ],
        ])
            ->add('prenom', TextType::class, [
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
            ->add('telephone', TextType::class, [
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
            ->add('object', TextType::class, [
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
                    'placeholder' => 'Objet de message',
                ],
            ])
            ->add('message', TextareaType::class, [
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
            ->add('confidencionality', CheckboxType::class, [

                'required' => false,
                'label' => 'En soumettant ce formulaire, j\'accepte que mes données personnelles soient utilisées pour me recontacter. Aucun autre traitement ne sera effectué avec mes informations. Pour connaître et exercer vos droits, veuillez consultez la
                <a target="_blank" href="doc/Confidencialité.pdf">Politique de confidentialité</a>.',
                'label_html' => true,
                'constraints' => [
                    new Assert\IsTrue([
                        'message' => 'Vous devez accepter la politique de confidentialité pour continuer.',
                    ]),
                ],
            ])
            ->add('envoyer', SubmitType::class)
            ->add('honeypot', TextType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => ['style' => 'display:none;'], // Cela cache le champ.
                'label' => false, // Cela indique qu'il n'y aura pas de label.
                'label_attr' => ['style' => 'display:none;'], // Cela n'est pas nécessaire si le label est déjà désactivé avec 'label' => false.
            ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true, // Active la protection CSRF
            'csrf_field_name' => '_token', // Nom du champ caché pour le jeton CSRF
        ]);
    }
}
