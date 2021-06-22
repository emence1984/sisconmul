<?php

namespace App\Form;

use App\Entity\SmPersona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistroPersonaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identificacion')
            ->add('nombre')
            ->add('apellido')
            ->add('email', EmailType::class)
            ->add('telefono')
            ->add('Grabar', SubmitType::class)
           // ->add('estado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SmPersona::class,
        ]);
    }
}
