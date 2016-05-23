<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhTipoDeduccion
 *
 * @ORM\Table(name="rh_tipo_deduccion")
 * @ORM\Entity
 */
class RhTipoDeduccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_deduccion", type="string", length=60, nullable=false)
     */
    private $nombreDeduccion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;



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
     * Set nombreDeduccion
     *
     * @param string $nombreDeduccion
     * @return RhTipoDeduccion
     */
    public function setNombreDeduccion($nombreDeduccion)
    {
        $this->nombreDeduccion = $nombreDeduccion;

        return $this;
    }

    /**
     * Get nombreDeduccion
     *
     * @return string 
     */
    public function getNombreDeduccion()
    {
        return $this->nombreDeduccion;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RhTipoDeduccion
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
     public function __toString() {
  return $this->nombreDeduccion;
}
}
