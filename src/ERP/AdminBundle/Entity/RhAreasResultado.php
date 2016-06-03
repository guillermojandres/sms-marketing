<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhAreasResultado
 *
 * @ORM\Table(name="rh_areas_resultado", indexes={@ORM\Index(name="fk_rh_areas_resultado_rh_evaluacion1_idx", columns={"rh_evaluacion_id"})})
 * @ORM\Entity
 */
class RhAreasResultado
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
     * @ORM\Column(name="nombre_area", type="string", length=200, nullable=false)
     */
    private $nombreArea;

    /**
     * @var float
     *
     * @ORM\Column(name="porcentaje", type="float", precision=10, scale=0, nullable=false)
     */
    private $porcentaje;

    /**
     * @var \RhPlantillaEvaluacion
     *
     * @ORM\ManyToOne(targetEntity="RhPlantillaEvaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_evaluacion_id", referencedColumnName="id")
     * })
     */
    private $rhEvaluacion;



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
     * Set nombreArea
     *
     * @param string $nombreArea
     * @return RhAreasResultado
     */
    public function setNombreArea($nombreArea)
    {
        $this->nombreArea = $nombreArea;

        return $this;
    }

    /**
     * Get nombreArea
     *
     * @return string 
     */
    public function getNombreArea()
    {
        return $this->nombreArea;
    }

    /**
     * Set porcentaje
     *
     * @param float $porcentaje
     * @return RhAreasResultado
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return float 
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    /**
     * Set rhEvaluacion
     *
     * @param \ERP\AdminBundle\Entity\RhPlantillaEvaluacion $rhEvaluacion
     * @return RhAreasResultado
     */
    public function setRhEvaluacion(\ERP\AdminBundle\Entity\RhPlantillaEvaluacion $rhEvaluacion = null)
    {
        $this->rhEvaluacion = $rhEvaluacion;

        return $this;
    }

    /**
     * Get rhEvaluacion
     *
     * @return \ERP\AdminBundle\Entity\RhPlantillaEvaluacion 
     */
    public function getRhEvaluacion()
    {
        return $this->rhEvaluacion;
    }
}
