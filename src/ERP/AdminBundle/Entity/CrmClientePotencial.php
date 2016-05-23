<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmClientePotencial
 *
 * @ORM\Table(name="crm_cliente_potencial", indexes={@ORM\Index(name="fk_cliente_potencial_estado_cliente_potencial1_idx", columns={"estado_cliente_potencial_id"}), @ORM\Index(name="fk_cliente_potencial_referencia_cliente1_idx", columns={"referencia_cliente_id"}), @ORM\Index(name="fk_cliente_potencial_usuario1_idx", columns={"id_usuario_siguiente_contacto"}), @ORM\Index(name="fk_cliente_potencial_usuario2_idx", columns={"id_usuario_propietario"}), @ORM\Index(name="fk_cliente_potencial_territorio1_idx", columns={"territorio_id"}), @ORM\Index(name="fk_cliente_potencial_industria_cliente1_idx", columns={"industria_cliente_id"}), @ORM\Index(name="fk_crm_cliente_potencial_crm_empresa_cliente1_idx", columns={"crm_empresa_cliente_id"})})
 * @ORM\Entity
 */
class CrmClientePotencial
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email_id", type="string", length=100, nullable=false)
     */
    private $emailId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="siguiente_fecha_contacto", type="date", nullable=true)
     */
    private $siguienteFechaContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="movil", type="string", length=20, nullable=true)
     */
    private $movil;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="sitio_web", type="string", length=255, nullable=true)
     */
    private $sitioWeb;

    /**
     * @var \CtlEstadoClientePotencial
     *
     * @ORM\ManyToOne(targetEntity="CtlEstadoClientePotencial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_cliente_potencial_id", referencedColumnName="id")
     * })
     */
    private $estadoClientePotencial;

    /**
     * @var \CtlIndustriaCliente
     *
     * @ORM\ManyToOne(targetEntity="CtlIndustriaCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="industria_cliente_id", referencedColumnName="id")
     * })
     */
    private $industriaCliente;

    /**
     * @var \CtlReferenciaCliente
     *
     * @ORM\ManyToOne(targetEntity="CtlReferenciaCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="referencia_cliente_id", referencedColumnName="id")
     * })
     */
    private $referenciaCliente;

    /**
     * @var \CtlTerritorio
     *
     * @ORM\ManyToOne(targetEntity="CtlTerritorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="territorio_id", referencedColumnName="id")
     * })
     */
    private $territorio;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="CtlUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_siguiente_contacto", referencedColumnName="id")
     * })
     */
    private $idUsuarioSiguienteContacto;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="CtlUsuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_propietario", referencedColumnName="id")
     * })
     */
    private $idUsuarioPropietario;

    /**
     * @var \CrmEmpresaCliente
     *
     * @ORM\ManyToOne(targetEntity="CrmEmpresaCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crm_empresa_cliente_id", referencedColumnName="id")
     * })
     */
    private $crmEmpresaCliente;

    
    
     /**
     * @var string
     *
     * @ORM\Column(name="sector_mercado", type="string", length=50, nullable=true)
     */
    private $sector_mercado;
    
    
    
    


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
     * Set nombre
     *
     * @param string $nombre
     * @return CrmClientePotencial
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set emailId
     *
     * @param string $emailId
     * @return CrmClientePotencial
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;

        return $this;
    }

    /**
     * Get emailId
     *
     * @return string 
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * Set siguienteFechaContacto
     *
     * @param \DateTime $siguienteFechaContacto
     * @return CrmClientePotencial
     */
    public function setSiguienteFechaContacto($siguienteFechaContacto)
    {
        $this->siguienteFechaContacto = $siguienteFechaContacto;

        return $this;
    }

    /**
     * Get siguienteFechaContacto
     *
     * @return \DateTime 
     */
    public function getSiguienteFechaContacto()
    {
        return $this->siguienteFechaContacto;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return CrmClientePotencial
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set movil
     *
     * @param string $movil
     * @return CrmClientePotencial
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return CrmClientePotencial
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set sitioWeb
     *
     * @param string $sitioWeb
     * @return CrmClientePotencial
     */
    public function setSitioWeb($sitioWeb)
    {
        $this->sitioWeb = $sitioWeb;

        return $this;
    }

    /**
     * Get sitioWeb
     *
     * @return string 
     */
    public function getSitioWeb()
    {
        return $this->sitioWeb;
    }

    /**
     * Set estadoClientePotencial
     *
     * @param \ERP\AdminBundle\Entity\CtlEstadoClientePotencial $estadoClientePotencial
     * @return CrmClientePotencial
     */
    public function setEstadoClientePotencial(\ERP\AdminBundle\Entity\CtlEstadoClientePotencial $estadoClientePotencial = null)
    {
        $this->estadoClientePotencial = $estadoClientePotencial;

        return $this;
    }

    /**
     * Get estadoClientePotencial
     *
     * @return \ERP\AdminBundle\Entity\CtlEstadoClientePotencial 
     */
    public function getEstadoClientePotencial()
    {
        return $this->estadoClientePotencial;
    }

    /**
     * Set industriaCliente
     *
     * @param \ERP\AdminBundle\Entity\CtlIndustriaCliente $industriaCliente
     * @return CrmClientePotencial
     */
    public function setIndustriaCliente(\ERP\AdminBundle\Entity\CtlIndustriaCliente $industriaCliente = null)
    {
        $this->industriaCliente = $industriaCliente;

        return $this;
    }

    /**
     * Get industriaCliente
     *
     * @return \ERP\AdminBundle\Entity\CtlIndustriaCliente 
     */
    public function getIndustriaCliente()
    {
        return $this->industriaCliente;
    }

    /**
     * Set referenciaCliente
     *
     * @param \ERP\AdminBundle\Entity\CtlReferenciaCliente $referenciaCliente
     * @return CrmClientePotencial
     */
    public function setReferenciaCliente(\ERP\AdminBundle\Entity\CtlReferenciaCliente $referenciaCliente = null)
    {
        $this->referenciaCliente = $referenciaCliente;

        return $this;
    }

    /**
     * Get referenciaCliente
     *
     * @return \ERP\AdminBundle\Entity\CtlReferenciaCliente 
     */
    public function getReferenciaCliente()
    {
        return $this->referenciaCliente;
    }

    /**
     * Set territorio
     *
     * @param \ERP\AdminBundle\Entity\CtlTerritorio $territorio
     * @return CrmClientePotencial
     */
    public function setTerritorio(\ERP\AdminBundle\Entity\CtlTerritorio $territorio = null)
    {
        $this->territorio = $territorio;

        return $this;
    }

    /**
     * Get territorio
     *
     * @return \ERP\AdminBundle\Entity\CtlTerritorio 
     */
    public function getTerritorio()
    {
        return $this->territorio;
    }

    /**
     * Set idUsuarioSiguienteContacto
     *
     * @param \ERP\AdminBundle\Entity\Usuario $idUsuarioSiguienteContacto
     * @return CrmClientePotencial
     */
    public function setIdUsuarioSiguienteContacto(\ERP\AdminBundle\Entity\CtlUsuario $idUsuarioSiguienteContacto = null)
    {
        $this->idUsuarioSiguienteContacto = $idUsuarioSiguienteContacto;

        return $this;
    }

    /**
     * Get idUsuarioSiguienteContacto
     *
     * @return \ERP\AdminBundle\Entity\Usuario 
     */
    public function getIdUsuarioSiguienteContacto()
    {
        return $this->idUsuarioSiguienteContacto;
    }

    /**
     * Set idUsuarioPropietario
     *
     * @param \ERP\AdminBundle\Entity\Usuario $idUsuarioPropietario
     * @return CrmClientePotencial
     */
    public function setIdUsuarioPropietario(\ERP\AdminBundle\Entity\CtlUsuario $idUsuarioPropietario = null)
    {
        $this->idUsuarioPropietario = $idUsuarioPropietario;

        return $this;
    }

    /**
     * Get idUsuarioPropietario
     *
     * @return \ERP\AdminBundle\Entity\Usuario 
     */
    public function getIdUsuarioPropietario()
    {
        return $this->idUsuarioPropietario;
    }

    
    
    
    /**
     * Set crmEmpresaCliente
     *
     * @param \ERP\AdminBundle\Entity\CrmEmpresaCliente $crmEmpresaCliente
     * @return CrmClientePotencial
     */
    public function setCrmEmpresaCliente(\ERP\AdminBundle\Entity\CrmEmpresaCliente $crmEmpresaCliente = null)
    {
        $this->crmEmpresaCliente = $crmEmpresaCliente;

        return $this;
    }

    /**
     * Get crmEmpresaCliente
     *
     * @return \ERP\AdminBundle\Entity\CrmEmpresaCliente 
     */
    public function getCrmEmpresaCliente()
    {
        return $this->crmEmpresaCliente;
    }
    
    
    
    
    
    
     /**
     * Set sector_mercado
     *
     * @param string $sector_mercado
     * @return CrmClientePotencial
     */
    public function setSectorMercado($sector_mercado)
    {
        $this->sector_mercado = $sector_mercado;

        return $this;
    }

    /**
     * Get sector_mercado
     *
     * @return string 
     */
    public function getSectorMercado()
    {
        return $this->sector_mercado;
    }
    
    
   public function __toString() {
        
         return $this->nombre;
   }
    
    
    
    
    
    
    
}
