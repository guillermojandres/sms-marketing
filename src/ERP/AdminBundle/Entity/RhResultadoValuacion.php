<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhResultadoValuacion
 *
 * @ORM\Table(name="rh_resultado_valuacion", indexes={@ORM\Index(name="fk_rh_resultado_valuacion_rh_areas_resultado1_idx", columns={"rh_areas_resultado_id"}), @ORM\Index(name="fk_rh_resultado_valuacion_rh_evaluacion1_idx", columns={"rh_evaluacion_id"})})
 * @ORM\Entity
 */
class RhResultadoValuacion
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
     * @var \RhAreasResultado
     *
     * @ORM\ManyToOne(targetEntity="RhAreasResultado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_areas_resultado_id", referencedColumnName="id")
     * })
     */
    private $rhAreasResultado;

    /**
     * @var \RhEvaluacion
     *
     * @ORM\ManyToOne(targetEntity="RhEvaluacion")
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
     * Set rhAreasResultado
     *
     * @param \ERP\AdminBundle\Entity\RhAreasResultado $rhAreasResultado
     * @return RhResultadoValuacion
     */
    public function setRhAreasResultado(\ERP\AdminBundle\Entity\RhAreasResultado $rhAreasResultado = null)
    {
        $this->rhAreasResultado = $rhAreasResultado;

        return $this;
    }

    /**
     * Get rhAreasResultado
     *
     * @return \ERP\AdminBundle\Entity\RhAreasResultado 
     */
    public function getRhAreasResultado()
    {
        return $this->rhAreasResultado;
    }

    /**
     * Set rhEvaluacion
     *
     * @param \ERP\AdminBundle\Entity\RhEvaluacion $rhEvaluacion
     * @return RhResultadoValuacion
     */
    public function setRhEvaluacion(\ERP\AdminBundle\Entity\RhEvaluacion $rhEvaluacion = null)
    {
        $this->rhEvaluacion = $rhEvaluacion;

        return $this;
    }

    /**
     * Get rhEvaluacion
     *
     * @return \ERP\AdminBundle\Entity\RhEvaluacion 
     */
    public function getRhEvaluacion()
    {
        return $this->rhEvaluacion;
    }
}
