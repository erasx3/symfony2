<?php

namespace Pepe\PepeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Pepe\PepeBundle\Form\EventListener\AddLocalidadFieldSubscriber;
use Pepe\PepeBundle\Form\EventListener\AddProvinciaFieldSubscriber;

class facturaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $factory = $builder->getFormFactory();
        $localidadSubscriber = new AddLocalidadFieldSubscriber($factory);
        $builder->addEventSubscriber($localidadSubscriber);
        $provinciaSubscriber = new AddProvinciaFieldSubscriber($factory);
        $builder->addEventSubscriber($provinciaSubscriber);
        
        $builder
            ->add('nroFactura')
//            ->add('fecha')
            ->add('fecha','date',array(
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'attr' => array('class' => 'date') 
                ))
            ->add('total')
            ->add('condicion')
            ->add('iva')
//            ->add('localidades')
        ; 
        $builder->add('detalles', 'collection', array(
            'type'         => new detalleType(),
            'allow_add'    => true,
            'by_reference' => false,
        ));
                
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pepe\PepeBundle\Entity\factura'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pepe_pepebundle_factura';
    }
}
