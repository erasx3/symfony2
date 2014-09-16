<?php

namespace Pepe\PepeBundle\Entity;

use Doctrine\ORM\EntityRepository;


class facturaRepository extends EntityRepository
{
    public function getAcFacturasFiltradas($filtrosArray){
        $qb = $this->createQueryBuilder('f');
        if($filtrosArray['nroFactura']){
            $qb->where('f.nroFactura = :nroFactura')
                    ->setParameter('nroFactura', $filtrosArray['nroFactura']);
        }
        return $qb->getQuery()->getResult();
    }
    
}
