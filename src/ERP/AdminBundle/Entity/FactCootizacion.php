<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactCootizacion
 *
 * @ORM\Table(name="fact_cootizacion", indexes={@ORM\Index(name="fk_fact_cootizacion_fact_estado_cootizacion1_idx", columns={"fact_estado_cootizacion_id"}), @ORM\Index(name="fk_fact_cootizacion_crm_cliente_potencial1_idx", columns={"crm_cliente_potencial_id"}), @ORM\Index(name="fk_fact_cootizacion_crm_cliente1_idx", columns={"crm_cliente_id"})})
 * @ORM\Entity
 */
class FactCootizacion
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
     * @ORM\Column(name="fecha_emision", type="date", nullable=false)
     */
    private $fechaEmision;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="date", nullable=true)
     */
    private $fechaExpiracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_insercion", type="date", nullable=true)
     */
    private $fechaInsercion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="date", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=true)
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="terminos_condiciones", type="string", length=255, nullable=true)
     */
    private $terminosCondiciones;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_destinatarios", type="string", length=255, nullable=true)
     */
    private $notaDestinatarios;

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
     * @var \CtlEstadoCootizacion
     *
     * @ORM\ManyToOne(targetEntity="CtlEstadoCootizacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fact_estado_cootizacion_id", referencedColumnName="id")
     * })
     */
    private $factEstadoCootizacion;



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
     * Set fechaEmision
     *
     * @param \DateTime $fechaEmision
     * @return FactCootizacion
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fechaEmision = $fechaEmision;

        return $this;
    }

    /**
     * Get fechaEmision
     *
     * @return \DateTime 
     */
    public function getFechaEmision()
    {
        return $this->fechaEmision;
    }

    /**
     * Set fechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     * @return FactCootizacion
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;

        return $this;
    }

    /**
     * Get fechaExpiracion
     *
     * @return \DateTime 
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * Set fechaInsercion
     *
     * @param \DateTime $fechaInsercion
     * @return FactCootizacion
     */
    public function setFechaInsercion($fechaInsercion)
    {
        $this->fechaInsercion = $fechaInsercion;

        return $this;
    }

    /**
     * Get fechaInsercion
     *
     * @return \DateTime 
     */
    public function getFechaInsercion()
    {
        return $this->fechaInsercion;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return FactCootizacion
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return FactCootizacion
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set terminosCondiciones
     *
     * @param string $terminosCondiciones
     * @return FactCootizacion
     */
    public function setTerminosCondiciones($terminosCondiciones)
    {
        $this->terminosCondiciones = $terminosCondiciones;

        return $this;
    }

    /**
     * Get terminosCondiciones
     *
     * @return string 
     */
    public function getTerminosCondiciones()
    {
        return $this->terminosCondiciones;
    }

    /**
     * Set notaDestinatarios
     *
     * @param string $notaDestinatarios
     * @return FactCootizacion
     */
    public function setNotaDestinatarios($notaDestinatarios)
    {
        $this->notaDestinatarios = $notaDestinatarios;

        return $this;
    }

    /**
     * Get notaDestinatarios
     *
     * @return string 
     */
    public function getNotaDestinatarios()
    {
        return $this->notaDestinatarios;
    }

    /**
     * Set crmCliente
     *
     * @param \ERP\AdminBundle\Entity\CrmCliente $crmCliente
     * @return FactCootizacion
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
     * @return FactCootizacion
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

    /**
     * Set factEstadoCootizacion
     *
     * @param \ERP\AdminBundle\Entity\CtlEstadoCootizacion $factEstadoCootizacion
     * @return FactCootizacion
     */
    public function setFactEstadoCootizacion(\ERP\AdminBundle\Entity\CtlEstadoCootizacion $factEstadoCootizacion = null)
    {
        $this->factEstadoCootizacion = $factEstadoCootizacion;

        return $this;
    }

    /**
     * Get factEstadoCootizacion
     *
     * @return \ERP\AdminBundle\Entity\CtlEstadoCootizacion 
     */
    public function getFactEstadoCootizacion()
    {
        return $this->factEstadoCootizacion;
    }
}
