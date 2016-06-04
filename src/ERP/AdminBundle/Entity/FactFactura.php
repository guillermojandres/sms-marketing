<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactFactura
 *
 * @ORM\Table(name="fact_factura", uniqueConstraints={@ORM\UniqueConstraint(name="correlativo", columns={"correlativo"})}, indexes={@ORM\Index(name="fact_fecha_idUsuario", columns={"fact_fecha_idUsuario"}), @ORM\Index(name="fact_idterminopago", columns={"fact_idterminopago"}), @ORM\Index(name="fat_id_estado_factura", columns={"fat_id_estado_factura"}), @ORM\Index(name="fk_fact_factura_crm_cliente_potencial1_idx", columns={"crm_cliente_potencial_id"}), @ORM\Index(name="fk_fact_factura_crm_cliente1_idx", columns={"crm_cliente_id"})})
 * @ORM\Entity
 */
class FactFactura
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
     * @var integer
     *
     * @ORM\Column(name="correlativo", type="integer", nullable=false)
     */
    private $correlativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fact_fecha_emision", type="date", nullable=false)
     */
    private $factFechaEmision;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fact_fecha_pago", type="date", nullable=false)
     */
    private $factFechaPago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fact_fecha_insercion", type="datetime", nullable=false)
     */
    private $factFechaInsercion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fact_fecha_modificacion", type="datetime", nullable=false)
     */
    private $factFechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="fact_idterminopago", type="integer", nullable=false)
     */
    private $factIdterminopago;

    /**
     * @var string
     *
     * @ORM\Column(name="fact_terminos_condisiones", type="text", length=65535, nullable=false)
     */
    private $factTerminosCondisiones;

    /**
     * @var string
     *
     * @ORM\Column(name="fact_nota_destinatarios", type="text", length=65535, nullable=false)
     */
    private $factNotaDestinatarios;

    /**
     * @var string
     *
     * @ORM\Column(name="fact_otra_nota", type="text", length=65535, nullable=false)
     */
    private $factOtraNota;

    /**
     * @var string
     *
     * @ORM\Column(name="fact_otro_archivo", type="text", length=65535, nullable=false)
     */
    private $factOtroArchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fat_id_estado_factura", type="integer", nullable=false)
     */
    private $fatIdEstadoFactura;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fact_fecha_idUsuario", referencedColumnName="id")
     * })
     */
    private $factFechausuario;

    /**
     * @var \CrmCliente
     *
     * @ORM\ManyToOne(targetEntity="CrmCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crm_cliente_id", referencedColumnName="id")
     * })
     */
    private $crmCliente;

    /**
     * @var \CrmClientePotencial
     *
     * @ORM\ManyToOne(targetEntity="CrmClientePotencial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crm_cliente_potencial_id", referencedColumnName="id")
     * })
     */
    private $crmClientePotencial;



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
     * Set correlativo
     *
     * @param integer $correlativo
     * @return FactFactura
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
     * Set factFechaEmision
     *
     * @param \DateTime $factFechaEmision
     * @return FactFactura
     */
    public function setFactFechaEmision($factFechaEmision)
    {
        $this->factFechaEmision = $factFechaEmision;

        return $this;
    }

    /**
     * Get factFechaEmision
     *
     * @return \DateTime 
     */
    public function getFactFechaEmision()
    {
        return $this->factFechaEmision;
    }

    /**
     * Set factFechaPago
     *
     * @param \DateTime $factFechaPago
     * @return FactFactura
     */
    public function setFactFechaPago($factFechaPago)
    {
        $this->factFechaPago = $factFechaPago;

        return $this;
    }

    /**
     * Get factFechaPago
     *
     * @return \DateTime 
     */
    public function getFactFechaPago()
    {
        return $this->factFechaPago;
    }

    /**
     * Set factFechaInsercion
     *
     * @param \DateTime $factFechaInsercion
     * @return FactFactura
     */
    public function setFactFechaInsercion($factFechaInsercion)
    {
        $this->factFechaInsercion = $factFechaInsercion;

        return $this;
    }

    /**
     * Get factFechaInsercion
     *
     * @return \DateTime 
     */
    public function getFactFechaInsercion()
    {
        return $this->factFechaInsercion;
    }

    /**
     * Set factFechaModificacion
     *
     * @param \DateTime $factFechaModificacion
     * @return FactFactura
     */
    public function setFactFechaModificacion($factFechaModificacion)
    {
        $this->factFechaModificacion = $factFechaModificacion;

        return $this;
    }

    /**
     * Get factFechaModificacion
     *
     * @return \DateTime 
     */
    public function getFactFechaModificacion()
    {
        return $this->factFechaModificacion;
    }

    /**
     * Set factIdterminopago
     *
     * @param integer $factIdterminopago
     * @return FactFactura
     */
    public function setFactIdterminopago($factIdterminopago)
    {
        $this->factIdterminopago = $factIdterminopago;

        return $this;
    }

    /**
     * Get factIdterminopago
     *
     * @return integer 
     */
    public function getFactIdterminopago()
    {
        return $this->factIdterminopago;
    }

    /**
     * Set factTerminosCondisiones
     *
     * @param string $factTerminosCondisiones
     * @return FactFactura
     */
    public function setFactTerminosCondisiones($factTerminosCondisiones)
    {
        $this->factTerminosCondisiones = $factTerminosCondisiones;

        return $this;
    }

    /**
     * Get factTerminosCondisiones
     *
     * @return string 
     */
    public function getFactTerminosCondisiones()
    {
        return $this->factTerminosCondisiones;
    }

    /**
     * Set factNotaDestinatarios
     *
     * @param string $factNotaDestinatarios
     * @return FactFactura
     */
    public function setFactNotaDestinatarios($factNotaDestinatarios)
    {
        $this->factNotaDestinatarios = $factNotaDestinatarios;

        return $this;
    }

    /**
     * Get factNotaDestinatarios
     *
     * @return string 
     */
    public function getFactNotaDestinatarios()
    {
        return $this->factNotaDestinatarios;
    }

    /**
     * Set factOtraNota
     *
     * @param string $factOtraNota
     * @return FactFactura
     */
    public function setFactOtraNota($factOtraNota)
    {
        $this->factOtraNota = $factOtraNota;

        return $this;
    }

    /**
     * Get factOtraNota
     *
     * @return string 
     */
    public function getFactOtraNota()
    {
        return $this->factOtraNota;
    }

    /**
     * Set factOtroArchivo
     *
     * @param string $factOtroArchivo
     * @return FactFactura
     */
    public function setFactOtroArchivo($factOtroArchivo)
    {
        $this->factOtroArchivo = $factOtroArchivo;

        return $this;
    }

    /**
     * Get factOtroArchivo
     *
     * @return string 
     */
    public function getFactOtroArchivo()
    {
        return $this->factOtroArchivo;
    }

    /**
     * Set fatIdEstadoFactura
     *
     * @param integer $fatIdEstadoFactura
     * @return FactFactura
     */
    public function setFatIdEstadoFactura($fatIdEstadoFactura)
    {
        $this->fatIdEstadoFactura = $fatIdEstadoFactura;

        return $this;
    }

    /**
     * Get fatIdEstadoFactura
     *
     * @return integer 
     */
    public function getFatIdEstadoFactura()
    {
        return $this->fatIdEstadoFactura;
    }

    /**
     * Set factFechausuario
     *
     * @param \ERP\AdminBundle\Entity\Usuario $factFechausuario
     * @return FactFactura
     */
    public function setFactFechausuario(\ERP\AdminBundle\Entity\Usuario $factFechausuario = null)
    {
        $this->factFechausuario = $factFechausuario;

        return $this;
    }

    /**
     * Get factFechausuario
     *
     * @return \ERP\AdminBundle\Entity\Usuario 
     */
    public function getFactFechausuario()
    {
        return $this->factFechausuario;
    }

    /**
     * Set crmCliente
     *
     * @param \ERP\AdminBundle\Entity\CrmCliente $crmCliente
     * @return FactFactura
     */
    public function setCrmCliente(\ERP\AdminBundle\Entity\CrmCliente $crmCliente = null)
    {
        $this->crmCliente = $crmCliente;

        return $this;
    }

    /**
     * Get crmCliente
     *
     * @return \ERP\AdminBundle\Entity\CrmCliente 
     */
    public function getCrmCliente()
    {
        return $this->crmCliente;
    }

    /**
     * Set crmClientePotencial
     *
     * @param \ERP\AdminBundle\Entity\CrmClientePotencial $crmClientePotencial
     * @return FactFactura
     */
    public function setCrmClientePotencial(\ERP\AdminBundle\Entity\CrmClientePotencial $crmClientePotencial = null)
    {
        $this->crmClientePotencial = $crmClientePotencial;

        return $this;
    }

    /**
     * Get crmClientePotencial
     *
     * @return \ERP\AdminBundle\Entity\CrmClientePotencial 
     */
    public function getCrmClientePotencial()
    {
        return $this->crmClientePotencial;
    }
}
