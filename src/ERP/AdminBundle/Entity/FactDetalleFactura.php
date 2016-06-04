<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactDetalleFactura
 *
 * @ORM\Table(name="fact_detalle_factura", indexes={@ORM\Index(name="det_idimpuesto", columns={"det_idimpuesto"}), @ORM\Index(name="det_idfactura", columns={"det_idfactura"}), @ORM\Index(name="fk_fact_detalle_factura_inv_producto1_idx", columns={"inv_producto_id"})})
 * @ORM\Entity
 */
class FactDetalleFactura
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
     * @ORM\Column(name="det_descripcion", type="text", length=65535, nullable=false)
     */
    private $detDescripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="det_cantidad", type="integer", nullable=false)
     */
    private $detCantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="det_preciounidad", type="float", precision=10, scale=0, nullable=false)
     */
    private $detPreciounidad;

    /**
     * @var float
     *
     * @ORM\Column(name="det_total", type="float", precision=10, scale=0, nullable=false)
     */
    private $detTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="correlativo", type="integer", nullable=false)
     */
    private $correlativo;

    /**
     * @var float
     *
     * @ORM\Column(name="det_pocentaje_imp", type="float", precision=10, scale=0, nullable=false)
     */
    private $detPocentajeImp;

    /**
     * @var \CtlImpuesto
     *
     * @ORM\ManyToOne(targetEntity="CtlImpuesto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="det_idimpuesto", referencedColumnName="id")
     * })
     */
    private $detimpuesto;

    /**
     * @var \FactFactura
     *
     * @ORM\ManyToOne(targetEntity="FactFactura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="det_idfactura", referencedColumnName="id")
     * })
     */
    private $detfactura;

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
     * Set detDescripcion
     *
     * @param string $detDescripcion
     * @return FactDetalleFactura
     */
    public function setDetDescripcion($detDescripcion)
    {
        $this->detDescripcion = $detDescripcion;

        return $this;
    }

    /**
     * Get detDescripcion
     *
     * @return string 
     */
    public function getDetDescripcion()
    {
        return $this->detDescripcion;
    }

    /**
     * Set detCantidad
     *
     * @param integer $detCantidad
     * @return FactDetalleFactura
     */
    public function setDetCantidad($detCantidad)
    {
        $this->detCantidad = $detCantidad;

        return $this;
    }

    /**
     * Get detCantidad
     *
     * @return integer 
     */
    public function getDetCantidad()
    {
        return $this->detCantidad;
    }

    /**
     * Set detPreciounidad
     *
     * @param float $detPreciounidad
     * @return FactDetalleFactura
     */
    public function setDetPreciounidad($detPreciounidad)
    {
        $this->detPreciounidad = $detPreciounidad;

        return $this;
    }

    /**
     * Get detPreciounidad
     *
     * @return float 
     */
    public function getDetPreciounidad()
    {
        return $this->detPreciounidad;
    }

    /**
     * Set detTotal
     *
     * @param float $detTotal
     * @return FactDetalleFactura
     */
    public function setDetTotal($detTotal)
    {
        $this->detTotal = $detTotal;

        return $this;
    }

    /**
     * Get detTotal
     *
     * @return float 
     */
    public function getDetTotal()
    {
        return $this->detTotal;
    }

    /**
     * Set correlativo
     *
     * @param integer $correlativo
     * @return FactDetalleFactura
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
     * Set detPocentajeImp
     *
     * @param float $detPocentajeImp
     * @return FactDetalleFactura
     */
    public function setDetPocentajeImp($detPocentajeImp)
    {
        $this->detPocentajeImp = $detPocentajeImp;

        return $this;
    }

    /**
     * Get detPocentajeImp
     *
     * @return float 
     */
    public function getDetPocentajeImp()
    {
        return $this->detPocentajeImp;
    }

    /**
     * Set detimpuesto
     *
     * @param \ERP\AdminBundle\Entity\CtlImpuesto $detimpuesto
     * @return FactDetalleFactura
     */
    public function setDetimpuesto(\ERP\AdminBundle\Entity\CtlImpuesto $detimpuesto = null)
    {
        $this->detimpuesto = $detimpuesto;

        return $this;
    }

    /**
     * Get detimpuesto
     *
     * @return \ERP\AdminBundle\Entity\CtlImpuesto 
     */
    public function getDetimpuesto()
    {
        return $this->detimpuesto;
    }

    /**
     * Set detfactura
     *
     * @param \ERP\AdminBundle\Entity\FactFactura $detfactura
     * @return FactDetalleFactura
     */
    public function setDetfactura(\ERP\AdminBundle\Entity\FactFactura $detfactura = null)
    {
        $this->detfactura = $detfactura;

        return $this;
    }

    /**
     * Get detfactura
     *
     * @return \ERP\AdminBundle\Entity\FactFactura 
     */
    public function getDetfactura()
    {
        return $this->detfactura;
    }

    /**
     * Set invProducto
     *
     * @param \ERP\AdminBundle\Entity\InvProducto $invProducto
     * @return FactDetalleFactura
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
