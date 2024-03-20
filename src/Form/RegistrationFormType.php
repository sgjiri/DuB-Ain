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
            ->add('email', EmailType::class)
            ->add('RGPDConsent', CheckboxType::class, [
                'mapped' => false,
                // 'mapped' => false signifie que ce champ n'est pas directement lié à une propriété de l'entité User
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // au lieu d'être défini directement sur l'objet,
                // ce champ est lu et encodé dans le contrôleur
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                        // longueur maximale autorisée par Symfony pour des raisons de sécurité
                        'max' => 100,
                        'maxMessage' => 'Votre mot de passe doit comporter au maximum {{ limit }} caractères',
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
