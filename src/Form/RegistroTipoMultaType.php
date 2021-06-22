<?php

namespace App\Form;

use App\Entity\SmTipoMulta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistroTipoMultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')
            ->add('valor' , MoneyType::class, array(
                'currency' => 'USD',
                'divisor' => 1))
            ->add('Grabar', SubmitType::class)
           // ->add('estado')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SmTipoMulta::class,
        ]);
    }
}
