<?php

namespace Pepe\PepeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * provincia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pepe\PepeBundle\Entity\provinciaRepository")
 */
class provincia {

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
     *
     * @ORM\OneToMany(targetEntity="localidad", mappedBy="provincia")
     */
    private $localidades;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return provincia
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->localidades = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add localidades
     *
     * @param \Pepe\PepeBundle\Entity\localidad $localidades
     * @return provincia
     */
    public function addLocalidade(\Pepe\PepeBundle\Entity\localidad $localidades) {
        $this->localidades[] = $localidades;

        return $this;
    }

    /**
     * Remove localidades
     *
     * @param \Pepe\PepeBundle\Entity\localidad $localidades
     */
    public function removeLocalidade(\Pepe\PepeBundle\Entity\localidad $localidades) {
        $this->localidades->removeElement($localidades);
    }

    /**
     * Get localidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLocalidades() {
        return $this->localidades;
    }

    public function __toString() {
        return $this->descripcion;
    }

}
