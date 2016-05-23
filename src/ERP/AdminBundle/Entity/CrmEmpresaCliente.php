<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmEmpresaCliente
 *
 * @ORM\Table(name="crm_empresa_cliente")
 * @ORM\Entity(repositoryClass="ERP\CRMBundle\Repository\CrmEmpresaClienteRepository")
 */
class CrmEmpresaCliente
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
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=250, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="NRC", type="string", length=25, nullable=true)
     */
    private $nrc;

    /**
     * @var string
     *
     * @ORM\Column(name="NIT", type="string", length=25, nullable=true)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="giro", type="string", length=100, nullable=true)
     */
    private $giro;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=25, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=25, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=50, nullable=true)
     */
    private $correo;
    
    
    /**
     * @var integer
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
     * Set nombre
     *
     * @param string $nombre
     * @return CrmEmpresaCliente
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
     * @return CrmEmpresaCliente
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
     * Set nrc
     *
     * @param string $nrc
     * @return CrmEmpresaCliente
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
     * @return CrmEmpresaCliente
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
     * Set giro
     *
     * @param string $giro
     * @return CrmEmpresaCliente
     */
    public function setGiro($giro)
    {
        $this->giro = $giro;

        return $this;
    }

    /**
     * Get giro
     *
     * @return string 
     */
    public function getGiro()
    {
        return $this->giro;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return CrmEmpresaCliente
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return CrmEmpresaCliente
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
     * Set correo
     *
     * @param string $correo
     * @return CrmEmpresaCliente
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }
    
    
    
    
    
    
    
    /**
     * Set estado
     *
     * @param string $estado
     * @return CrmEmpresaCliente
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
    
    
    
    
    
    
    
}
