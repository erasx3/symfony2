<?php

namespace Pepe\PepeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pepe\PepeBundle\Form\EventListener\AddLocalidadFieldSubscriber;
use Pepe\PepeBundle\Form\EventListener\AddProvinciaFieldSubscriber;

class facturaFilterType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $factory = $builder->getFormFactory();
        $provinciaSubscriber = new AddProvinciaFieldSubscriber($factory);
        $builder->addEventSubscriber($provinciaSubscriber);
        $localidadSubscriber = new AddLocalidadFieldSubscriber($factory);
        $builder->addEventSubscriber($localidadSubscriber);
        
        $builder
        ->add('nroFactura', 'number', array(
        'required' => false
        ))
        ->add('fecha', 'date', array(
        'format' => 'dd-MM-yyyy',
        'empty_value' => '',
        'widget' => 'single_text',
        'required' => false,
        'attr' => array('class' => 'date')
        ))
        ->add('total', 'number', array(
        'read_only' => true,
        'empty_data' => '0',
        'disabled' => true
        ))
        ->add('iva', 'entity', array('required' => true,
        'class' => 'PepeBundle:iva',
        'empty_value' => '',
            'required'=> false,
            ))
        ->add('condicion', 'entity', array(
        'required' => false,
        'class' => 'PepeBundle:condicionPago',
        'empty_value' => '',
        ))        
//        ->add('provincia', 'entity', array(
//        'class' => 'FacturaBundle:Provincia',
//        'mapped'=> false,
//            ))
//       ->add('localidad', 'entity', array(
//            'required' => true,
//            'class' => 'FacturaBundle:Localidad',
//            'empty_value' => '',           
//        ))

        ;
        
//        $builder->add('detalles', 'collection', array(
//            'type' => new DetalleType(),
//            'allow_add' => true,
//            'by_reference' => false
//        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pepe_pepebundle_factura';
    }

}
