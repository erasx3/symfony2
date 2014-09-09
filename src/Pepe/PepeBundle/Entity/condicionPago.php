<?php

namespace Pepe\PepeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * condicionPago
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class condicionPago
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="factura", mappedBy="condicion")
     */
    private $facturas;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return condicionPago
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facturas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add facturas
     *
     * @param \Pepe\PepeBundle\Entity\factura $facturas
     * @return condicionPago
     */
    public function addFactura(\Pepe\PepeBundle\Entity\factura $facturas)
    {
        $this->facturas[] = $facturas;

        return $this;
    }

    /**
     * Remove facturas
     *
     * @param \Pepe\PepeBundle\Entity\factura $facturas
     */
    public function removeFactura(\Pepe\PepeBundle\Entity\factura $facturas)
    {
        $this->facturas->removeElement($facturas);
    }

    /**
     * Get facturas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturas()
    {
        return $this->facturas;
    }
    public function __toString(){
        return $this->descripcion;
    }
}
