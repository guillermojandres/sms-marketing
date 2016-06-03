<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvSucursal
 *
 * @ORM\Table(name="inv_sucursal")
 * @ORM\Entity
 */
class InvSucursal
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=50, nullable=true)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion1", type="string", length=200, nullable=false)
     */
    private $direccion1;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion2", type="string", length=200, nullable=true)
     */
    private $direccion2;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=100, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia_estado", type="string", length=25, nullable=false)
     */
    private $provinciaEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_zip", type="string", length=10, nullable=true)
     */
    private $postalZip;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
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
     * @return InvSucursal
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
     * Set alias
     *
     * @param string $alias
     * @return InvSucursal
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set direccion1
     *
     * @param string $direccion1
     * @return InvSucursal
     */
    public function setDireccion1($direccion1)
    {
        $this->direccion1 = $direccion1;

        return $this;
    }

    /**
     * Get direccion1
     *
     * @return string 
     */
    public function getDireccion1()
    {
        return $this->direccion1;
    }

    /**
     * Set direccion2
     *
     * @param string $direccion2
     * @return InvSucursal
     */
    public function setDireccion2($direccion2)
    {
        $this->direccion2 = $direccion2;

        return $this;
    }

    /**
     * Get direccion2
     *
     * @return string 
     */
    public function getDireccion2()
    {
        return $this->direccion2;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return InvSucursal
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set provinciaEstado
     *
     * @param string $provinciaEstado
     * @return InvSucursal
     */
    public function setProvinciaEstado($provinciaEstado)
    {
        $this->provinciaEstado = $provinciaEstado;

        return $this;
    }

    /**
     * Get provinciaEstado
     *
     * @return string 
     */
    public function getProvinciaEstado()
    {
        return $this->provinciaEstado;
    }

    /**
     * Set postalZip
     *
     * @param string $postalZip
     * @return InvSucursal
     */
    public function setPostalZip($postalZip)
    {
        $this->postalZip = $postalZip;

        return $this;
    }

    /**
     * Get postalZip
     *
     * @return string 
     */
    public function getPostalZip()
    {
        return $this->postalZip;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return InvSucursal
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
