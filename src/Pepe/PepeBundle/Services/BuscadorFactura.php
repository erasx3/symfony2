<?php

namespace Pepe\PepeBundle\Services;

use Doctrine\ORM\EntityManager;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BuscadorFactura{
    private $em;
    
    public function __construct(EntityManager $entityManager) {
        $this->em = $entityManager;
    }
    
    public function getAcFacturasFiltradas($arrayFiltros){
        $facturas = $this->em->getRepository('PepeBundle:factura')->getAcFacturasFiltradas($arrayFiltros);
        return $facturas;
    }
}

