<?php

namespace Pepe\PepeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class productoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descripcion')
            ->add('precio')
            ->add('precioCosto')
            ->add('activo')
            ->add('fechaAlta','date',array(
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'attr' => array('class' => 'date') 
                ))
            ->add('proveedor')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pepe\PepeBundle\Entity\producto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pepe_pepebundle_producto';
    }
}
