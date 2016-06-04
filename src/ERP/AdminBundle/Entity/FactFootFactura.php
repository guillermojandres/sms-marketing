<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactFootFactura
 *
 * @ORM\Table(name="fact_foot_factura", indexes={@ORM\Index(name="foot_idfactura", columns={"foot_idfactura"})})
 * @ORM\Entity
 */
class FactFootFactura
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
     * @ORM\Column(name="foot_descuento", type="float", precision=10, scale=0, nullable=false)
     */
    private $footDescuento;

    /**
     * @var integer
     *
     * @ORM\Column(name="foot_costo_envio", type="integer", nullable=false)
     */
    private $footCostoEnvio;

    /**
     * @var float
     *
     * @ORM\Column(name="foot_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $footTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="correlativo", type="integer", nullable=false)
     */
    private $correlativo;

    /**
     * @var \FactFactura
     *
     * @ORM\ManyToOne(targetEntity="FactFactura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="foot_idfactura", referencedColumnName="id")
     * })
     */
    private $footfactura;



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
     * Set footDescuento
     *
     * @param float $footDescuento
     * @return FactFootFactura
     */
    public function setFootDescuento($footDescuento)
    {
        $this->footDescuento = $footDescuento;

        return $this;
    }

    /**
     * Get footDescuento
     *
     * @return float 
     */
    public function getFootDescuento()
    {
        return $this->footDescuento;
    }

    /**
     * Set footCostoEnvio
     *
     * @param integer $footCostoEnvio
     * @return FactFootFactura
     */
    public function setFootCostoEnvio($footCostoEnvio)
    {
        $this->footCostoEnvio = $footCostoEnvio;

        return $this;
    }

    /**
     * Get footCostoEnvio
     *
     * @return integer 
     */
    public function getFootCostoEnvio()
    {
        return $this->footCostoEnvio;
    }

    /**
     * Set footTotal
     *
     * @param float $footTotal
     * @return FactFootFactura
     */
    public function setFootTotal($footTotal)
    {
        $this->footTotal = $footTotal;

        return $this;
    }

    /**
     * Get footTotal
     *
     * @return float 
     */
    public function getFootTotal()
    {
        return $this->footTotal;
    }

    /**
     * Set correlativo
     *
     * @param integer $correlativo
     * @return FactFootFactura
     */
    public function setCorrelativo($correlativo)
    {
        $this->correlativo = $correlativo;

        return $this;
    }

    /**
     * Get correlativo
     *
     * @return integer 
     */
    public function getCorrelativo()
    {
        return $this->correlativo;
    }

    /**
     * Set footfactura
     *
     * @param \ERP\AdminBundle\Entity\FactFactura $footfactura
     * @return FactFootFactura
     */
    public function setFootfactura(\ERP\AdminBundle\Entity\FactFactura $footfactura = null)
    {
        $this->footfactura = $footfactura;

        return $this;
    }

    /**
     * Get footfactura
     *
     * @return \ERP\AdminBundle\Entity\FactFactura 
     */
    public function getFootfactura()
    {
        return $this->footfactura;
    }
}
