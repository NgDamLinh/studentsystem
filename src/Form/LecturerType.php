<?php

namespace App\Form;

use App\Entity\Lecturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LecturerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lecID')
            ->add('lecName')
            ->add('DOB')
            ->add('Image')
            ->add('SubjLec')
            ->add('Classes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lecturer::class,
        ]);
    }
}
