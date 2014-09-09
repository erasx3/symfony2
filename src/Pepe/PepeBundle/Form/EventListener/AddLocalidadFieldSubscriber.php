<?php
 
namespace Pepe\PepeBundle\Form\EventListener;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Pepe\PepeBundle\Entity\provincia;
 
class AddLocalidadFieldSubscriber implements EventSubscriberInterface
{
    private $factory;
 
    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_BIND     => 'preBind'
        );
    }
 
    private function addLocalidadForm($form, $provincia)
    {
        $form->add($this->factory->createNamed('localidades','entity', null, array(
            'class'         => 'PepeBundle:localidad',
            'empty_value'   => 'localidades',
            'auto_initialize' => false,
            'query_builder' => function (EntityRepository $repository) use ($provincia) {
                $qb = $repository->createQueryBuilder('localidades')
                    ->innerJoin('localidades.provincia', 'provincia');
                if ($provincia instanceof provincia) {
                    $qb->where('localidades.provincia = :provincia')
                    ->setParameter('provincia', $provincia);
                } elseif (is_numeric($provincia)) {
                    $qb->where('provincia.id = :provincia')
                    ->setParameter('provincia', $provincia);
                } else {
                    $qb->where('provincia.descripcion = :provincia')
                    ->setParameter('provincia', null);
                }
 
                return $qb;
            }
        )));
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }       
        
        $provincia = ($data->getLocalidades()) ? $data->getLocalidades()->getProvincia() : null;
        $this->addLocalidadForm($form, $provincia);
    }
 
    public function preBind(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
 
        $provincia = array_key_exists('provincia', $data) ? $data['provincia'] : null;
        $this->addLocalidadForm($form, $provincia);
    }
}