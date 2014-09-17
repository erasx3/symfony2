<?php

namespace Pepe\PepeBundle\Form;

use Doctrine\ORM\EntityRepository;
use Pepe\PepeBundle\Form\EventListener\AddLocalidadFieldSubscriber;
use Pepe\PepeBundle\Form\EventListener\AddProvinciaFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class facturaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $factory = $builder->getFormFactory();
        $localidadSubscriber = new AddLocalidadFieldSubscriber($factory);
        $builder->addEventSubscriber($localidadSubscriber);
        $provinciaSubscriber = new AddProvinciaFieldSubscriber($factory);
        $builder->addEventSubscriber($provinciaSubscriber);
//        $ivaSubscriber = new EventListener\AddIvaFieldSubscriber($factory);
//        $builder->addEventSubscriber($ivaSubscriber);

        $builder
        ->add('nroFactura', 'number', array(
        'required' => true
        ))
        ->add('fecha', 'date', array(
        'widget' => 'single_text',
        'format' => 'dd-MM-yyyy',
        'required' => true,
        'attr' => array('class' => 'date')
        ))
        ->add('total', 'number', array(
//            'read_only' => true,
        'empty_data' => '0,00',
//            'disabled' => true
        ))
        ->add('condicion', 'entity', array(
                'required' => true,
                'class' => 'PepeBundle:condicionPago',
                'empty_value' => '',
        ))
//            ->add('iva', 'entity', array(
//            'required' => true,
//            'class' => 'PepeBundle:iva',
//            'empty_value' => ''
//                ))
//            ->add('localidades')
        ->add('iva', 'entity', array('required' => true,
                'class' => 'PepeBundle:iva',
                'empty_value' => '',
                'query_builder' => function(EntityRepository $iva) {
                return $iva->createQueryBuilder('iva')
                ->where('iva.activo = true');
        
                
                }));
        
        $builder->add('detalles', 'collection', array(
            'type' => new detalleType(),
            'allow_add' => true,
            'by_reference' => false,
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Pepe\PepeBundle\Entity\factura'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'pepe_pepebundle_factura';
    }

}
