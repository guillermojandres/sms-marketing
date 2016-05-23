<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhPlantillaEvaluacion
 *
 * @ORM\Table(name="rh_plantilla_evaluacion")
 * @ORM\Entity
 */
class RhPlantillaEvaluacion
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
     * @ORM\Column(name="nombre_evaluacion", type="string", length=45, nullable=false)
     */
    private $nombreEvaluacion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=45, nullable=true)
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
     * Set nombreEvaluacion
     *
     * @param string $nombreEvaluacion
     * @return RhPlantillaEvaluacion
     */
    public function setNombreEvaluacion($nombreEvaluacion)
    {
        $this->nombreEvaluacion = $nombreEvaluacion;

        return $this;
    }

    /**
     * Get nombreEvaluacion
     *
     * @return string 
     */
    public function getNombreEvaluacion()
    {
        return $this->nombreEvaluacion;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RhPlantillaEvaluacion
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
}
