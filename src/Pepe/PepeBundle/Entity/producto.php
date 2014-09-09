<?php

namespace Pepe\PepeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * producto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class producto
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
     * @var float
     *
     * @ORM\Column(name="precio", type="float")
     */
    private $precio;

    /**
     * @var float
     *
     * @ORM\Column(name="precioCosto", type="float")
     */
    private $precioCosto;

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="string", length=255)
     */
    private $activo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAlta", type="date")
     */
    private $fechaAlta;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="detalle", mappedBy="producto")
     */
    private $detalles;
    
    /**
     *
     * @var type @ORM\ManyToOne(targetEntity="proveedor", inversedBy="productos")
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id")
     */
    private $proveedor;
    
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
     * @return producto
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
     * Set precio
     *
     * @param float $precio
     * @return producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set precioCosto
     *
     * @param float $precioCosto
     * @return producto
     */
    public function setPrecioCosto($precioCosto)
    {
        $this->precioCosto = $precioCosto;

        return $this;
    }

    /**
     * Get precioCosto
     *
     * @return float 
     */
    public function getPrecioCosto()
    {
        return $this->precioCosto;
    }

    /**
     * Set activo
     *
     * @param string $activo
     * @return producto
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return string 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set fechaAlta
     *
     * @param \DateTime $fechaAlta
     * @return producto
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    /**
     * Get fechaAlta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->detalles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add detalles
     *
     * @param \Pepe\PepeBundle\Entity\detalle $detalles
     * @return producto
     */
    public function addDetalle(\Pepe\PepeBundle\Entity\detalle $detalles)
    {
        $this->detalles[] = $detalles;

        return $this;
    }

    /**
     * Remove detalles
     *
     * @param \Pepe\PepeBundle\Entity\detalle $detalles
     */
    public function removeDetalle(\Pepe\PepeBundle\Entity\detalle $detalles)
    {
        $this->detalles->removeElement($detalles);
    }

    /**
     * Get detalles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDetalles()
    {
        return $this->detalles;
    }

    /**
     * Set proveedor
     *
     * @param \Pepe\PepeBundle\Entity\proveedor $proveedor
     * @return producto
     */
    public function setProveedor(\Pepe\PepeBundle\Entity\proveedor $proveedor = null)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Pepe\PepeBundle\Entity\proveedor 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }
    public function __toString(){
        return $this->descripcion;
    }
}
