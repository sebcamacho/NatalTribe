<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                
                'label' => 'Saisissez votre nom *',
                'attr' => [
                    'placeholder' => 'Saisissez votre nom'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ],
            ])
            ->add('email', EmailType::class, [
                
                'label' => 'Saisissez votre adresse e-mail *',
                'attr' => [
                    'placeholder' => 'Saisissez votre adresse e-mail *'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ]
            ])
            ->add('entreprise', TextType::class, [
                
                'label' => 'Entreprise',
                'attr' => [
                    'placeholder' => 'Entreprise'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                'required' => false
            ])
            ->add('objet', TextType::class, [
                
                'label' => 'Objet *',
                'attr' => [
                    'placeholder' => 'Objet *'
                ],
                'row_attr' => [
                    'class' => 'form-floating'
                ],
                'required' => true
            ])
            ->add('message', TextareaType::class, [
                    'label' => 'Saisissez votre demande *',
                    'attr' => [
                        'placeholder' => "Saisissez votre demande *"
                    ],
                    'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
