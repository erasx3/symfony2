<?php

namespace Pepe\PepeBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class detalleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad')
            ->add('factura')
//            ->add('producto');
            ->add('producto', 'entity', array('required' => true,
                    'class' => 'PepeBundle:Producto',
                    'empty_value' => '',
                    'query_builder' => function(EntityRepository $prod) {
                        return $prod->createQueryBuilder('producto')
                                ->where('producto.activo = true');
                    }
            ));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pepe\PepeBundle\Entity\detalle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pepe_pepebundle_detalle';
    }
}
