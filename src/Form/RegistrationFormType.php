<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('nom', TextType::class, [
                'label' => 'Nom *',
                'attr' => [
                    'placeholder' => 'nom'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                'constraints' => [
                        new Length([
                            'min' => 2,
                            'minMessage' => 'Votre nom doit avoir au moins {{ limit }} caractères',
                            'max' => 30,
                            'maxMessage' => 'Oups ! Votre nom est trop long'
                        ])
                    ]
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom *',
                'attr' => [
                    'placeholder' => 'Prénom'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                'constraints' => [
                        new Length([
                            'min' => 2,
                            'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères',
                            'max' => 30,
                            'maxMessage' => 'Oups ! Votre prénom est trop long'
                        ])
                    ]
                
            ])
            ->add('telephone', TelType::class, [
                    'label' => 'Numéro de téléphone (nécessaire pour les cours enfants)',
                    'attr' => [
                    'placeholder' => 'Numéro de téléphone'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                    'constraints' => [
                        new Length([
                            'min' => 10,
                            'minMessage' => 'Votre numéro de Télephone doit contenir au moins {{ limit }} chiffres',
                            'max' => 12,
                            'maxMessage' => 'Oups ! Votre numéro est trop long'
                        ])
                    ]
                    
            ])
            ->add('a_propos', TextareaType::class, [
                    'label' => 'À propos',
                    'attr' => [
                        'placeholder' => "À propos : nous serions heureux d'en savoir un peu plus sur vous, votre niveau, les raisons pour lesquelles vous vous intéressez au yoga..."
                    ],
                    'required' => false
            ])
            ->add('agreeTerms', CheckboxType::class, [
                    'label' => "J'accepte",
                    'constraints' => [
                        new IsTrue([
                            'message' => 'Vous devez accepter les termes.',
                        ])],
                    'mapped' => false
                    ])
         

            ->add('email', EmailType::class, [
                'label' => 'E-mail *',
                'attr' => [
                    'placeholder' => 'E-mail'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'required' => true,
                'first_options' => [ 'label' => 'Mot de passe *'],
                'second_options' => [ 'label' => 'Confirmez votre mot de passe *']
                
            ]);
            
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
