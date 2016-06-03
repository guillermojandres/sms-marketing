<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlSucursal
 *
 * @ORM\Table(name="ctl_sucursal", indexes={@ORM\Index(name="fk_sucursal_empresa1_idx", columns={"ctl_empresa_id"}), @ORM\Index(name="fk_ctl_sucursal_ctl_ciudad1_idx", columns={"ctl_ciudad_id"})})
 * @ORM\Entity
 */
class CtlSucursal
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
     * @ORM\Column(name="nombre_sucursal", type="string", length=45, nullable=false)
     */
    private $nombreSucursal;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_fijo", type="string", length=10, nullable=false)
     */
    private $telefonoFijo;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="correoelectronico", type="string", length=45, nullable=true)
     */
    private $correoelectronico;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_sucursal", type="string", length=205, nullable=false)
     */
    private $direccionSucursal;

    /**
     * @var \CtlCiudad
     *
     * @ORM\ManyToOne(targetEntity="CtlCiudad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ctl_ciudad_id", referencedColumnName="id")
     * })
     */
    private $ctlCiudad;

    /**
     * @var \CtlEmpresa
     *
     * @ORM\ManyToOne(targetEntity="CtlEmpresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ctl_empresa_id", referencedColumnName="id")
     * })
     */
    private $ctlEmpresa;



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
     * Set nombreSucursal
     *
     * @param string $nombreSucursal
     * @return CtlSucursal
     */
    public function setNombreSucursal($nombreSucursal)
    {
        $this->nombreSucursal = $nombreSucursal;

        return $this;
    }

    /**
     * Get nombreSucursal
     *
     * @return string 
     */
    public function getNombreSucursal()
    {
        return $this->nombreSucursal;
    }

    /**
     * Set telefonoFijo
     *
     * @param string $telefonoFijo
     * @return CtlSucursal
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    /**
     * Get telefonoFijo
     *
     * @return string 
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return CtlSucursal
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
     * Set correoelectronico
     *
     * @param string $correoelectronico
     * @return CtlSucursal{% extends 'base.html.twig' %}
     */
    public function setCorreoelectronico($correoelectronico)
    {
        $this->correoelectronico = $correoelectronico;

        return $this;
    }

    /**
     * Get correoelectronico
     *
     * @return string 
     */
    public function getCorreoelectronico()
    {
        return $this->correoelectronico;
    }

    /**
     * Set direccionSucursal
     *
     * @param string $direccionSucursal
     * @return CtlSucursal
     */
    public function setDireccionSucursal($direccionSucursal)
    {
        $this->direccionSucursal = $direccionSucursal;

        return $this;
    }

    /**
     * Get direccionSucursal
     *
     * @return string 
     */
    public function getDireccionSucursal()
    {
        return $this->direccionSucursal;
    }

    /**
     * Set ctlCiudad
     *
     * @param \ERP\AdminBundle\Entity\CtlCiudad $ctlCiudad
     * @return CtlSucursal
     */
    public function setCtlCiudad(\ERP\AdminBundle\Entity\CtlCiudad $ctlCiudad = null)
    {
        $this->ctlCiudad = $ctlCiudad;

        return $this;
    }

    /**
     * Get ctlCiudad
     *
     * @return \ERP\AdminBundle\Entity\CtlCiudad 
     */
    public function getCtlCiudad()
    {
        return $this->ctlCiudad;
    }

    /**
     * Set ctlEmpresa
     *
     * @param \ERP\AdminBundle\Entity\CtlEmpresa $ctlEmpresa
     * @return CtlSucursal
     */
    public function setCtlEmpresa(\ERP\AdminBundle\Entity\CtlEmpresa $ctlEmpresa = null)
    {
        $this->ctlEmpresa = $ctlEmpresa;

        return $this;
    }

    /**
     * Get ctlEmpresa
     *
     * @return \ERP\AdminBundle\Entity\CtlEmpresa 
     */
    public function getCtlEmpresa()
    {
        return $this->ctlEmpresa;
    }
     public function __toString() {
  return $this->nombreSucursal;
}
}
