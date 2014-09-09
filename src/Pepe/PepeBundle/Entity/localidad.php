<?php

namespace Pepe\PepeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * localidad
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class localidad
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=255)
     */
    private $codigoPostal;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="provincia", inversedBy="localidades")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     * 
     */
    private $provincia;
    
    /**
     *
     *@ORM\OneToMany(targetEntity="factura", mappedBy="localidades")
     * 
     */
    private $factura;
    
    
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
     * @return localidad
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
     * Set codigoPostal
     *
     * @param string $codigoPostal
     * @return localidad
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string 
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set provincia
     *
     * @param \Pepe\PepeBundle\Entity\provincia $provincia
     * @return localidad
     */
    public function setProvincia(\Pepe\PepeBundle\Entity\provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Pepe\PepeBundle\Entity\provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
    public function __toString(){
        return $this->descripcion;
    }
 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->factura = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add factura
     *
     * @param \Pepe\PepeBundle\Entity\factura $factura
     * @return localidad
     */
    public function addFactura(\Pepe\PepeBundle\Entity\factura $factura)
    {
        $this->factura[] = $factura;

        return $this;
    }

    /**
     * Remove factura
     *
     * @param \Pepe\PepeBundle\Entity\factura $factura
     */
    public function removeFactura(\Pepe\PepeBundle\Entity\factura $factura)
    {
        $this->factura->removeElement($factura);
    }

    /**
     * Get factura
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFactura()
    {
        return $this->factura;
    }
}
