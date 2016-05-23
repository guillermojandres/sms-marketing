<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhSubgasto
 *
 * @ORM\Table(name="rh_subgasto", indexes={@ORM\Index(name="fk_sub_gastos_gastos1_idx", columns={"rh_gastos_id"})})
 * @ORM\Entity
 */
class RhSubgasto
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_gasto", type="date", nullable=false)
     */
    private $fechaGasto;

    /**
     * @var float
     *
     * @ORM\Column(name="importe_reembolso", type="float", precision=10, scale=0, nullable=false)
     */
    private $importeReembolso;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=350, nullable=true)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="monto_sancionado", type="float", precision=10, scale=0, nullable=true)
     */
    private $montoSancionado;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_gasto", type="string", length=45, nullable=false)
     */
    private $tipoGasto;

    /**
     * @var \RhGasto
     *
     * @ORM\ManyToOne(targetEntity="RhGasto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_gastos_id", referencedColumnName="id")
     * })
     */
    private $rhGastos;



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
     * Set fechaGasto
     *
     * @param \DateTime $fechaGasto
     * @return RhSubgasto
     */
    public function setFechaGasto($fechaGasto)
    {
        $this->fechaGasto = $fechaGasto;

        return $this;
    }

    /**
     * Get fechaGasto
     *
     * @return \DateTime 
     */
    public function getFechaGasto()
    {
        return $this->fechaGasto;
    }

    /**
     * Set importeReembolso
     *
     * @param float $importeReembolso
     * @return RhSubgasto
     */
    public function setImporteReembolso($importeReembolso)
    {
        $this->importeReembolso = $importeReembolso;

        return $this;
    }

    /**
     * Get importeReembolso
     *
     * @return float 
     */
    public function getImporteReembolso()
    {
        return $this->importeReembolso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return RhSubgasto
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
     * Set montoSancionado
     *
     * @param float $montoSancionado
     * @return RhSubgasto
     */
    public function setMontoSancionado($montoSancionado)
    {
        $this->montoSancionado = $montoSancionado;

        return $this;
    }

    /**
     * Get montoSancionado
     *
     * @return float 
     */
    public function getMontoSancionado()
    {
        return $this->montoSancionado;
    }

    /**
     * Set tipoGasto
     *
     * @param string $tipoGasto
     * @return RhSubgasto
     */
    public function setTipoGasto($tipoGasto)
    {
        $this->tipoGasto = $tipoGasto;

        return $this;
    }

    /**
     * Get tipoGasto
     *
     * @return string 
     */
    public function getTipoGasto()
    {
        return $this->tipoGasto;
    }

    /**
     * Set rhGastos
     *
     * @param \ERP\AdminBundle\Entity\RhGasto $rhGastos
     * @return RhSubgasto
     */
    public function setRhGastos(\ERP\AdminBundle\Entity\RhGasto $rhGastos = null)
    {
        $this->rhGastos = $rhGastos;

        return $this;
    }

    /**
     * Get rhGastos
     *
     * @return \ERP\AdminBundle\Entity\RhGasto 
     */
    public function getRhGastos()
    {
        return $this->rhGastos;
    }
}
