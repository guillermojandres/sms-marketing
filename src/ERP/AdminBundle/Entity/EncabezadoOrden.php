<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncabezadoOrden
 *
 * @ORM\Table(name="encabezado_orden", indexes={@ORM\Index(name="fk_encabezado_orden_cliente1", columns={"crm_cliente_id"})})
 * @ORM\Entity
 */
class EncabezadoOrden
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
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crm_cliente_id", referencedColumnName="id")
     * })
     */
    private $crmClienteId;
    
     /**
     * @var decimal
     *
     * @ORM\Column(name="monto", type="float", nullable=false)
     */
    private $monto;
     /**
     * @var string
     *
     * @ORM\Column(name="tipo_pago", type="string", length=25, nullable=true)
     */
    private $tipoPago;
    
    
      /**
     * @var string
     *
     * @ORM\Column(name="tipo_venta", type="string", length=20, nullable=true)
     */
    private $tipoVenta;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=true)
     */
    private $fechaRegistro;

   
    
     /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

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
     * Set crmClienteId
     *
     * @param \ERP\AdminBundle\Entity\Cliente $crmCliente
     * @return CrmCliente
     */
    public function setCrmCliente(\ERP\AdminBundle\Entity\Cliente  $crmClienteId = null)
    {
        $this->crmClienteId = $crmClienteId;

        return $this;
    }

    /**
     * Get crmClienteId
     *
     * @return \ERP\AdminBundle\Entity\Cliente $crmClienteId
     */
    public function getCrmClienteId()
    {
        return $this->crmClienteId;
    }  
    
     /**
     * Set monto
     *
     * @param decimal $monto
     * @return EncabezadoOrden
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return decimal 
     */
    public function getMonto()
    {
        return $this->monto;
    }
    
    
    /**
     * Set tipoPago
     *
     * @param string $tipoPago
     * @return EncabezadoOrden
     */
    public function setTipoPago($tipoPago)
    {
        $this->tipoPago = $tipoPago;

        return $this;
    }

    /**
     * Get tipoPago
     *
     * @return string 
     */
    public function getTipoPago()
    {
        return $this->tipoPago;
    }
    
    
    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return EncabezadoOrden
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
    
     /**
     * Set estado
     *
     * @param tinyint $estado
     * @return Orden
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
      /**
     * Set tipoVenta
     *
     * @param string $tipoVenta
     * @return EncabezadoOrden
     */
    public function setTipoVenta($tipoVenta)
    {
        $this->tipoVenta = $tipoVenta;

        return $this;
    }

    /**
     * Get tipoVenta
     *
     * @return string 
     */
    public function getTipoVenta()
    {
        return $this->tipoVenta;
    }
    

}
