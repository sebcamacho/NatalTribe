<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AccountFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Mon adresse mail'
            ])
            ->add('nom', TextType::class, [
                'disabled' => true,
                'label' => 'Mon nom'
            ])
            ->add('prenom', TextType::class, [
                'disabled' => true,
                'label' => 'Mon Prénom'
            ])
            ->add('telephone', TelType::class, [
                    'disabled' => true,
                    'label' => 'Numéro de téléphone'
                    
            ])
            ->add('a_propos', TextareaType::class, [
                    'disabled' => true,
                    'label' => 'À propos'
            ])
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}