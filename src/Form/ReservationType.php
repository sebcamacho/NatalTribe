<?php

namespace App\Form;

use App\Entity\Creneau;
use App\Entity\Reservation;
use Doctrine\ORM\EntityRepository;
use App\Repository\CreneauRepository;
use Symfony\Component\Form\AbstractType;
use DoctrineExtensions\Query\Mysql\DateFormat;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Container1qlIuoz\getCreneauRepositoryService;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $groupe = new Reservation;
        // $groupe = $groupe->getDateTime();
        

        $builder
            ->add('creneau', EntityType::class, [
                'class' => Creneau::class,
                'attr' =>[
                    
                    // 'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'
                ],
                
                'choice_label' => 'id',
                // 'choices' => $groupe,
                'multiple' => true,
                'expanded' => false,
                'choice_attr' => function (){ return ['class' => 'select-creneaux'];},
                // 'mapped' => false,
                // 
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                    ->orderBy('c.date', 'ASC');
                },
                'by_reference' => false,

            ])
            ->add('valider', SubmitType::class)
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
