<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvProductoTransaccion
 *
 * @ORM\Table(name="inv_producto_transaccion", indexes={@ORM\Index(name="fk_inv_producto_transaccion_inv_producto1_idx", columns={"inv_producto_id"})})
 * @ORM\Entity
 */
class InvProductoTransaccion
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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="string", length=45, nullable=true)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_transaccion", type="text", length=255, nullable=true)
     */
    private $tipoTransaccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="producto_id", type="integer", nullable=true)
     */
    private $productoId;

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
     * Set fecha
     *
     * @param string $fecha
     * @return InvProductoTransaccion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     * @return InvProductoTransaccion
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set tipoTransaccion
     *
     * @param string $tipoTransaccion
     * @return InvProductoTransaccion
     */
    public function setTipoTransaccion($tipoTransaccion)
    {
        $this->tipoTransaccion = $tipoTransaccion;

        return $this;
    }

    /**
     * Get tipoTransaccion
     *
     * @return string 
     */
    public function getTipoTransaccion()
    {
        return $this->tipoTransaccion;
    }

    /**
     * Set productoId
     *
     * @param integer $productoId
     * @return InvProductoTransaccion
     */
    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;

        return $this;
    }

    /**
     * Get productoId
     *
     * @return integer 
     */
    public function getProductoId()
    {
        return $this->productoId;
    }

    /**
     * Set invProducto
     *
     * @param \ERP\AdminBundle\Entity\InvProducto $invProducto
     * @return InvProductoTransaccion
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
