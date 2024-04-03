<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Classe qui définit le formulaire d'inscription d'un utilisateur.
 * Elle étend AbstractType qui est la classe de base pour la création de formulaire dans Symfony.
 */
class RegistrationFormType extends AbstractType
{
    /**
     * Construit le formulaire d'inscription.
     *
     * @param FormBuilderInterface $builder Le constructeur de formulaire.
     * @param array $options Les options du formulaire.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Ajoute un champ 'email' de type EmailType au formulaire.
        $builder
            ->add('email', EmailType::class, [
                // Définit les contraintes de validation pour le champ 'email'.
                'constraints' => [
                    // Le champ 'email' ne doit pas être vide.
                    new Assert\NotBlank([
                        'message' => 'Votre email est obligatoire.',
                    ]),
                    // Le champ 'email' doit être un email valide.
                    new Assert\Email([
                        'message' => 'L\'email n\'est pas valide.'
                    ]),
                    // La longueur de l'email doit être comprise entre 5 et 200 caractères.
                    new Assert\Length([
                        'min' => 5,
                        'max' => 200,
                        'minMessage' => 'Le message doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le message ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
                // Le champ 'email' est requis pour soumettre le formulaire.
                'required' => true,
                // Des attributs HTML supplémentaires pour le champ 'email', comme le placeholder.
                'attr' => [
                    'placeholder' => 'Votre email',
                ],
                // Le label qui sera affiché à côté du champ 'email'.
                'label' => "Email:"
            ])
            // Ajoute un champ 'plainPassword' de type PasswordType au formulaire.
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    // Le label qui sera affiché à côté du champ 'plainPassword'.
                    'label' => 'Mot de passe:',
                ],
                'second_options' =>[
                    'label' => 'Confirmation du mot de passe:',
                ],
                'invalid_message' => 'Les monts de passe ne corespendent pas',
                // 'mapped' => false indique que ce champ n'est pas directement lié à une propriété de l'entité User.
                'mapped' => false,
                
                // Des attributs HTML supplémentaires pour le champ 'plainPassword', comme le placeholder.
                'attr' => ['placeholder' => 'Mot de passe'],
                // Définit les contraintes de validation pour le champ 'plainPassword'.
                'constraints' => [
                    // Le champ 'plainPassword' ne doit pas être vide.
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    // Le champ 'plainPassword' doit respecter un certain format défini par l'expression régulière.
                    new Assert\Regex([
                        'pattern' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                        'message' => "Le mot de passe doit contenir au moins une lettre majuscule, une minuscule, un chiffre, un caractère spécial et être d'au moins 8 caractères de longueur.",
                    ]),
                ],
            ]);
    }

    /**
     * Configure les options pour ce type de formulaire.
     *
     * @param OptionsResolver $resolver Le résolveur d'options.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        // Définit les options par défaut pour ce type de formulaire.
        $resolver->setDefaults([
            // Associe ce formulaire à l'entité User, ce qui permet au formulaire de sauvegarder directement les données dans une instance de User.
            'data_class' => User::class,
        ]);
    }
}