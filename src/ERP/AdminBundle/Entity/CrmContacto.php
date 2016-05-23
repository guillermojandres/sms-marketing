<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmContacto
 *
 * @ORM\Table(name="crm_contacto")
 * @ORM\Entity
 */
class CrmContacto
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email_id", type="string", length=50, nullable=true)
     */
    private $emailId;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_movil", type="string", length=20, nullable=true)
     */
    private $numeroMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=50, nullable=true)
     */
    private $departamento;

    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", length=50, nullable=true)
     */
    private $puesto;
    
    
    
    
    /**
     * @var \InvProveedor
     *
     * @ORM\ManyToOne(targetEntity="InvProveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_proveedor_id", referencedColumnName="id")
     * })
     */
    private $contactoProveedorId;
    
    
    
    /**
     * @var \CrmClientePotencial
     *
     * @ORM\ManyToOne(targetEntity="CrmClientePotencial")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crm_cliente_potencial_id", referencedColumnName="id")
     * })
     */
    private $contactoClientePotencialId;
    
    
    
     
    /**
     * @var \CrmCliente
     *
     * @ORM\ManyToOne(targetEntity="CrmCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crm_cliente_id", referencedColumnName="id")
     * })
     */
    private $contactoClienteId;
    
    
    
    
    
    
    
    



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
     * @return CrmContacto
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
     * Set apellido
     *
     * @param string $apellido
     * @return CrmContacto
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return CrmContacto
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
     * Set emailId
     *
     * @param string $emailId
     * @return CrmContacto
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
     * Set numeroMovil
     *
     * @param string $numeroMovil
     * @return CrmContacto
     */
    public function setNumeroMovil($numeroMovil)
    {
        $this->numeroMovil = $numeroMovil;

        return $this;
    }

    /**
     * Get numeroMovil
     *
     * @return string 
     */
    public function getNumeroMovil()
    {
        return $this->numeroMovil;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     * @return CrmContacto
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return string 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     * @return CrmContacto
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return string 
     */
    public function getPuesto()
    {
        return $this->puesto;
    }
    
    
    
      /**
     * Set contactoProveedorId
     *
     * @param \ERP\AdminBundle\Entity\InvProveedor $contactoProveedorId
     * @return CrmContacto
     */
    public function setContactoProveedorId(\ERP\AdminBundle\Entity\InvProveedor $contactoProveedorId = null)
    {
        $this->contactoProveedorId = $contactoProveedorId;

        return $this;
    }

    /**
     * Get contactoProveedorId
     *
     * @return \ERP\AdminBundle\Entity\InvProveedor 
     */
    public function getContactoProveedorId()
    {
        return $this->contactoProveedorId;
    }
    
    

    
      /**
     * Set contactoClientePotencialId
     *
     * @param \ERP\AdminBundle\Entity\CrmClientePotencial $contactoClientePotencialId
     * @return CrmContacto
     */
    public function setContactoClientePotencialId(\ERP\AdminBundle\Entity\CrmClientePotencial $contactoClientePotencialId = null)
    {
        $this->contactoClientePotencialId = $contactoClientePotencialId;

        return $this;
    }

    /**
     * Get contactoClientePotencialId
     *
     * @return \ERP\AdminBundle\Entity\CrmClientePotencial 
     */
    public function getContactoClientePotencialId()
    {
        return $this->contactoClientePotencialId;
    }

    
    
     /**
     * Set contactoClienteId
     *
     * @param \ERP\AdminBundle\Entity\CrmCliente contactoClienteId
     * @return CrmContacto
     */
    public function setContactoClienteId(\ERP\AdminBundle\Entity\CrmCliente $contactoClienteId = null)
    {
        $this->contactoClienteId = $contactoClienteId;

        return $this;
    }

    /**
     * Get contactoClienteId
     *
     * @return \ERP\AdminBundle\Entity\CrmCliente 
     */
    public function getContactoClienteId()
    {
        return $this->contactoClienteId;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
