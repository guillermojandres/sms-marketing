<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvProveedor
 *
 * @ORM\Table(name="inv_proveedor", indexes={@ORM\Index(name="fk_inv_proveedor_crm_industria_cliente1_idx", columns={"crm_industria_cliente_id"})})
 * @ORM\Entity(repositoryClass="ERP\CRMBundle\Repository\InvProveedorRepository")
 */
class InvProveedor
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
     * @ORM\Column(name="direccion", type="string", length=250, nullable=false)
     */
    private $direccion;

    /**
     * @var \CtlIndustriaCliente
     *
     * @ORM\ManyToOne(targetEntity="CtlIndustriaCliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crm_industria_cliente_id", referencedColumnName="id")
     * })
     */
        private $crmIndustriaCliente;
    
    
    /**
     * @var integer
     * @ORM\Column(name="estado", type="integer", nullable=false) 
     */
    private $estado;

/**
     * @var string
     *
     * @ORM\Column(name="nrc", type="string", length=25, nullable=true)
     */
    private $nrc;

    /**
     * @var string
     *
     * @ORM\Column(name="nit", type="string", length=25, nullable=true)
     */
    private $nit;
    
     
    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=25, nullable=false)
     */
    private $telefono;


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
     * @return InvProveedor
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
     * Set direccion
     *
     * @param string $direccion
     * @return InvProveedor
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set crmIndustriaCliente
     *
     * @param \ERP\AdminBundle\Entity\CtlIndustriaCliente $crmIndustriaCliente
     * @return InvProveedor
     */
    public function setCrmIndustriaCliente(\ERP\AdminBundle\Entity\CtlIndustriaCliente $crmIndustriaCliente = null)
    {
        $this->crmIndustriaCliente = $crmIndustriaCliente;

        return $this;
    }

    /**
     * Get crmIndustriaCliente
     *
     * @return \ERP\AdminBundle\Entity\CtlIndustriaCliente 
     */
    public function getCrmIndustriaCliente()
    {
        return $this->crmIndustriaCliente;
    }
    
    
    
    
     /**
     * Set estado
     *
     * @param string $estado
     * @return InvProveedor
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
   
    
    
    public function __toString() {
        
         return $this->nombre;
    } 
    
     /**
     * Set nrc
     *
     * @param string $nrc
     * @return Cliente
     */
    public function setNrc($nrc)
    {
        $this->nrc = $nrc;

        return $this;
    }

    /**
     * Get nrc
     *
     * @return string 
     */
    public function getNrc()
    {
        return $this->nrc;
    }

    /**
     * Set nit
     *
     * @param string $nit
     * @return Cliente
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string 
     */
    public function getNit()
    {
        return $this->nit;
    }
    
     /**
     * Set telefono
     *
     * @param string $telefono
     * @return Cliente
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
    
    
    
}
