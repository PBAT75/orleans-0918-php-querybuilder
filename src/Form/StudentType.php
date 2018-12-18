<?php

namespace App\Form;

use App\Entity\School;
use App\Entity\Student;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $mascot = $options['mascot'];

        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('age')
            ->add('school', EntityType::class, [
                'class' => School::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) use ($mascot) {
                    return $er->createQueryBuilder('sc')
                        ->where('sc.mascot = :mascot')
                        ->setParameter('mascot', $mascot)
                        ->orderBy('sc.name', 'DESC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
            'mascot' => null,

        ]);
    }
}
