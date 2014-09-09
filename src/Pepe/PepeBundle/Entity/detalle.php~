<?php

namespace Pepe\PepeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * detalle
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class detalle
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
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="factura", inversedBy="detalles", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
     */
    private $factura;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="producto", inversedBy="detalles")
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id")
     */
    private $producto;
    
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return detalle
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set factura
     *
     * @param \Pepe\PepeBundle\Entity\factura $factura
     * @return detalle
     */
    public function setFactura(\Pepe\PepeBundle\Entity\factura $factura = null)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return \Pepe\PepeBundle\Entity\factura 
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set producto
     *
     * @param \Pepe\PepeBundle\Entity\producto $producto
     * @return detalle
     */
    public function setProducto(\Pepe\PepeBundle\Entity\producto $producto = null)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \Pepe\PepeBundle\Entity\producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
   
}
