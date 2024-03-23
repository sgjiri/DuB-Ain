<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Type de formulaire pour l'inscription d'un utilisateur.
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
        $builder
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
                'label' => "Email:"
            ])
            ->add('plainPassword', PasswordType::class, [
                // au lieu d'être défini directement sur l'objet,
                // ce champ est lu et encodé dans le contrôleur
                'mapped' => false,
                'label' => 'Mot de passe:',
                'attr' => ['placeholder' => 'Mot de passe',],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
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
        $resolver->setDefaults([
            'data_class' => User::class,
            // 'data_class' => User::class spécifie que ce formulaire sert à créer ou modifier des entités User
        ]);
    }
}
