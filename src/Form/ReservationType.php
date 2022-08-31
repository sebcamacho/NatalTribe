<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Creneau;
use App\Form\CreneauType;
use App\Entity\Reservation;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormInterface;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ReservationType extends AbstractType
{
 

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            // ->add('cours', EntityType::class, [
            //     'mapped' => false,
            //     'class' => Cours::class,
            //     'choice_label' => 'nom',
            //     'placeholder' => 'Cours',
            //     'label' => 'Cours'
            // ])
            ->add('creneau', textt::class, [
                // 'class' => Creneau::class,
                // 'entry_options' => [
                //     'attr' => ['class' => 'select-creneaux']
                // ],
                // 'choice_label' => 'datetime',
                // 'placeholder' => 'Créneaux (Sélectionner un cours ou un créneau dans le calendrier)',
                // 'multiple' => true,
                'label' => 'Créneaux',
                'by_reference' => false,
                // 'allow_add' => true,
                // 'allow_delete' => true
                // 'attr' => [
                //     'class' => 'select-creneaux'
                // ],
                

            ])
                
            // ])
            ->add('valider', SubmitType::class)
        ;

        // $formModifier = function(FormInterface $form, Cours $cours = null){
        //         $creneaux = (null === $cours) ? [] : $cours->getCreneaus();

        //         $form->add('creneau', EntityType::class, [
        //         'class' => Creneau::class,
        //         'choice_label' => 'datetime',
        //         'placeholder' => 'Créneaux',
        //         'label' => 'créneau',
        //         'choices' => $creneaux,
        //         'multiple' => true,
        //         'by_reference' => false,
        //         // 'allow_add' => true,
        //         // 'allow_delete' => true
        //         'attr' => [
        //             'class' => 'select-creneaux'
        //         ],

            //     ]);
            // };

            // $builder->get('cours')->addEventListener(
            //     FormEvents::POST_SUBMIT,
            //     function (FormEvent $event) use ($formModifier){
            //         $cours = $event->getForm()->getData();
            //         $formModifier($event->getForm()->getParent(), $cours);
            //     }
            // );

        

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            

        ]);
    }
}
