<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactDetalleCootizacion
 *
 * @ORM\Table(name="fact_detalle_cootizacion", indexes={@ORM\Index(name="fk_fact_detalle_cootizacion_fact_cootizacion1_idx", columns={"fact_cootizacion_id"}), @ORM\Index(name="fk_fact_detalle_cootizacion_fact_impuesto1_idx", columns={"fact_impuesto_id"}), @ORM\Index(name="fk_fact_detalle_cootizacion_inv_producto1_idx", columns={"inv_producto_id"})})
 * @ORM\Entity
 */
class FactDetalleCootizacion
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
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=false)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="precio_unidad", type="float", precision=10, scale=0, nullable=true)
     */
    private $precioUnidad;

    /**
     * @var float
     *
     * @ORM\Column(name="total_importe", type="float", precision=10, scale=0, nullable=true)
     */
    private $totalImporte;

    /**
     * @var float
     *
     * @ORM\Column(name="porcentaje", type="float", precision=10, scale=0, nullable=true)
     */
    private $porcentaje;

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
     * @var \CtlImpuesto
     *
     * @ORM\ManyToOne(targetEntity="CtlImpuesto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fact_impuesto_id", referencedColumnName="id")
     * })
     */
    private $factImpuesto;

    /**
     * @var \InvProducto
     *
     * @ORM\ManyToOne(targetEntity="InvProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_producto_id", referencedColumnName="id")
     * })
     */
    private $invProducto;



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
     * @return FactDetalleCootizacion
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
     * Set precioUnidad
     *
     * @param float $precioUnidad
     * @return FactDetalleCootizacion
     */
    public function setPrecioUnidad($precioUnidad)
    {
        $this->precioUnidad = $precioUnidad;

        return $this;
    }

    /**
     * Get precioUnidad
     *
     * @return float 
     */
    public function getPrecioUnidad()
    {
        return $this->precioUnidad;
    }

    /**
     * Set totalImporte
     *
     * @param float $totalImporte
     * @return FactDetalleCootizacion
     */
    public function setTotalImporte($totalImporte)
    {
        $this->totalImporte = $totalImporte;

        return $this;
    }

    /**
     * Get totalImporte
     *
     * @return float 
     */
    public function getTotalImporte()
    {
        return $this->totalImporte;
    }

    /**
     * Set porcentaje
     *
     * @param float $porcentaje
     * @return FactDetalleCootizacion
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
     * Set factCootizacion
     *
     * @param \ERP\AdminBundle\Entity\FactCootizacion $factCootizacion
     * @return FactDetalleCootizacion
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

    /**
     * Set factImpuesto
     *
     * @param \ERP\AdminBundle\Entity\CtlImpuesto $factImpuesto
     * @return FactDetalleCootizacion
     */
    public function setFactImpuesto(\ERP\AdminBundle\Entity\CtlImpuesto $factImpuesto = null)
    {
        $this->factImpuesto = $factImpuesto;

        return $this;
    }

    /**
     * Get factImpuesto
     *
     * @return \ERP\AdminBundle\Entity\CtlImpuesto 
     */
    public function getFactImpuesto()
    {
        return $this->factImpuesto;
    }

    /**
     * Set invProducto
     *
     * @param \ERP\AdminBundle\Entity\InvProducto $invProducto
     * @return FactDetalleCootizacion
     */
    public function setInvProducto(\ERP\AdminBundle\Entity\InvProducto $invProducto = null)
    {
        $this->invProducto = $invProducto;

        return $this;
    }

    /**
     * Get invProducto
     *
     * @return \ERP\AdminBundle\Entity\InvProducto 
     */
    public function getInvProducto()
    {
        return $this->invProducto;
    }
}
