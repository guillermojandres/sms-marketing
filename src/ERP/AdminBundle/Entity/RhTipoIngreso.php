<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhTipoIngreso
 *
 * @ORM\Table(name="rh_tipo_ingreso")
 * @ORM\Entity
 */
class RhTipoIngreso
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
     * @ORM\Column(name="nombre_ingresocol", type="string", length=60, nullable=false)
     */
    private $nombreIngresocol;

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
     * Set nombreIngresocol
     *
     * @param string $nombreIngresocol
     * @return RhTipoIngreso
     */
    public function setNombreIngresocol($nombreIngresocol)
    {
        $this->nombreIngresocol = $nombreIngresocol;

        return $this;
    }

    /**
     * Get nombreIngresocol
     *
     * @return string 
     */
    public function getNombreIngresocol()
    {
        return $this->nombreIngresocol;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RhTipoIngreso
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
  return $this->nombreIngresocol;
}
}
