<?php

namespace App\Form;

use App\Entity\SmPersona;
use App\Entity\SmUsuario;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegistroUsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('usuario')
            ->add('clave', PasswordType::class)
            ->add('tipo',  ChoiceType::class, array(
                'choices' => array(
                    'Administrador' => 'A',
                    'Usuario Normal' => 'U'
                ),
                'required'    => false,
                'placeholder' => 'Seleccione el tipo de usuario',
                'empty_data'  => null) )
            //->add('estado')
            // ->add('smPersona')


            ->add('smPersona', ChoiceType::class, [
                'choices' => [
                    new SmPersona('Er','Men'),
                ],
                // "name" is a property path, meaning Symfony will look for a public
                // property or a public method like "getName()" to define the input
                // string value that will be submitted by the form
                'choice_value' => 'id',
                // a callback to return the label for a given choice
                // if a placeholder is used, its empty value (null) may be passed but
                // its label is defined by its own "placeholder" option
                'choice_label' => function(?SmPersona $persona) {
                    return $persona ? strtoupper($persona->getNombreCompleto()) : '';
                },
                // returns the html attributes for each option input (may be radio/checkbox)
               /* 'choice_attr' => function(?SmPersona $persona) {
                    return $persona ? ['class' => 'Persona_'.strtolower($persona->getNombreCompleto())] : [];
                },*/
                // every option can use a string property path or any callable that get
                // passed each choice as argument, but it may not be needed
               /* 'group_by' => function() {
                    // randomly assign things into 2 groups
                    return rand(0, 1) == 1 ? 'Seleccione una Persona' : 'Group B';
                },*/
                // a callback to return whether a category is preferred
                /*'preferred_choices' => function(?SmPersona $persona) {
                    return $persona && 100 < $persona->getNombreCompleto();
                },*/
                'placeholder' => 'Seleccione una persona',
            ])



          /* ->add('smPersona', ChoiceType::class, array(
            'class' => 'chriscrudBundle:SmPersona',
            'property' => 'nombre',
            'query_builder' => function (EntityRepository $er){
                return $er->createQuery(
                    'SELECT p
                    FROM App\Entity\SmPersona p
                    WHERE p.estado IS NULL
                    ORDER BY p.apellido  ASC' );
                    ;
            },))*/
            
          /*>add('smPersona', ChoiceType::class, [
            'choices' => [
                new SmPersona(),
                new SmPersona(),
                new SmPersona(),
                new SmPersona(),
            ],
            'choices_as_values' => true,
            'choice_label' => function($persona, $key, $index) {
                 return strtoupper($persona->getNombreCompleto());
            },
            
            'choice_attr' => function($persona, $key, $index) {
                return ['class' => 'persona_'.strtolower($persona->getNombreCompleto())];
            },
            /*'group_by' => function($persona, $key, $index) {
                // asigna de forma aleatoria en dos grupos
                return rand(0, 1) == 1 ? 'Group A' : 'Group B'
            },
            'preferred_choices' => function($persona, $key, $index) {
                return $persona->getNombreCompleto() == 'Cat2' || $persona->getNombreCompleto() == 'Cat3';
            },
        ])        */  
            ->add('Grabar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SmUsuario::class,
        ]);
    }
}
