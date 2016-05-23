<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactFootCootizacion
 *
 * @ORM\Table(name="fact_foot_cootizacion", indexes={@ORM\Index(name="fk_foot_cootizacion_fact_cootizacion1_idx", columns={"fact_cootizacion_id"})})
 * @ORM\Entity
 */
class FactFootCootizacion
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
     * @var float
     *
     * @ORM\Column(name="descuento", type="float", precision=10, scale=0, nullable=true)
     */
    private $descuento;

    /**
     * @var float
     *
     * @ORM\Column(name="costo_envio", type="float", precision=10, scale=0, nullable=true)
     */
    private $costoEnvio;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", precision=10, scale=0, nullable=true)
     */
    private $total;

    /**
     * @var \FactCootizacion
     *
     * @ORM\ManyToOne(targetEntity="FactCootizacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fact_cootizacion_id", referencedColumnName="id")
     * })
     */
    private $factCootizacion;



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
     * Set descuento
     *
     * @param float $descuento
     * @return FactFootCootizacion
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return float 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set costoEnvio
     *
     * @param float $costoEnvio
     * @return FactFootCootizacion
     */
    public function setCostoEnvio($costoEnvio)
    {
        $this->costoEnvio = $costoEnvio;

        return $this;
    }

    /**
     * Get costoEnvio
     *
     * @return float 
     */
    public function getCostoEnvio()
    {
        return $this->costoEnvio;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return FactFootCootizacion
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set factCootizacion
     *
     * @param \ERP\AdminBundle\Entity\FactCootizacion $factCootizacion
     * @return FactFootCootizacion
     */
    public function setFactCootizacion(\ERP\AdminBundle\Entity\FactCootizacion $factCootizacion = null)
    {
        $this->factCootizacion = $factCootizacion;

        return $this;
    }

    /**
     * Get factCootizacion
     *
     * @return \ERP\AdminBundle\Entity\FactCootizacion 
     */
    public function getFactCootizacion()
    {
        return $this->factCootizacion;
    }
}
