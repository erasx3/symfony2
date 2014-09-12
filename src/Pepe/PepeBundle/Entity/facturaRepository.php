<?php

namespace Pepe\PepeBundle\Entity;

use Doctrine\ORM\EntityRepository;


class facturaRepository extends EntityRepository
{
    public function getAcFacturasFiltradas($filtrosArray){
        $qb = $this->createQueryBuilder('f');
        if($filtrosArray['numeroFactura']){
            $qb->where('f.numeroFactura = :nroFactura')
                    ->setParameter('nroFactura', $filtrosArray['numeroFactura']);
        }
        return $qb->getQuery()->getResult();
    }
    
}
