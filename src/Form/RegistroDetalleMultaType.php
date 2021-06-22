<?php

namespace App\Form;

use App\Entity\SmPersona;
use App\Entity\SmRegistroMultaDetalle;
use App\Entity\SmTipoMulta;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class RegistroDetalleMultaType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
   
        $listadoTipoMulta = $this->entityManager ->getRepository(SmTipoMulta::class) ->findAll();

        $listadoPersona = $this->entityManager ->getRepository(SmPersona::class) ->findAll();

        $builder
            ->add('fechaAplicacion', DateType::class,  [
                'widget' => 'choice',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'required' => true,               
                ] )
                
            ->add('smTipoMulta', ChoiceType::class,   [
                    'choices' => $listadoTipoMulta,
                    'required'    => true,
                    'choice_value' => 'id',
                    'choice_label' => function(?SmTipoMulta $tipo) {
                        return $tipo ? strtoupper($tipo->getDescripcion() .";  Valor: $ " .  round(($tipo->getValor()/100),2) ) : '';
                    }
                ])
         
      /*      ->add('valorMulta', MoneyType::class, [
                    'currency' => 'USD',
                    'divisor' => 100,
                    #'by_reference' => false,
                    'disabled'  => true,
                    #'mapped' => false,
                    /*'data'=> function(?SmTipoMulta $tipo) {
                        return $tipo ? $tipo->getValor() : 0.00;
                    }*/
             //   ])*/

            ->add('smPersona', ChoiceType::class,   [
                    'choices' => $listadoPersona,
                    'required'    => true,
                    'choice_value' => 'id',
                    'choice_label' => function(?SmPersona $persona) {
                        return $persona ? strtoupper($persona->getNombreCompleto()) : '';
                    }
                ])

            ->add('pagado', ChoiceType::class, [
                    'choices'  => [
                        'SI' => 'S',
                        'NO' => 'N',
                    ],
                ])
                    
            ->add('observacion', TextType::class, [
                'help' => 'Ingrese la observación de la multa a aplicar',
                'required' => true,
            ])
 
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => SmRegistroMultaDetalle::class,
        ]);
    }
}
