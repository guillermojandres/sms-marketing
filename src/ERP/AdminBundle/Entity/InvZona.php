<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvZona
 *
 * @ORM\Table(name="inv_zona", indexes={@ORM\Index(name="fk_inv_zona_inv_sucursal1_idx", columns={"inv_sucursal_id"})})
 * @ORM\Entity
 */
class InvZona
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
     * @ORM\Column(name="alias", type="string", length=50, nullable=true)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500, nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;

    /**
     * @var \InvSucursal
     *
     * @ORM\ManyToOne(targetEntity="InvSucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_sucursal_id", referencedColumnName="id")
     * })
     */
    private $invSucursal;



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
     * @return InvZona
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
     * @return InvZona
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return InvZona
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return InvZona
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

    /**
     * Set invSucursal
     *
     * @param \ERP\AdminBundle\Entity\InvSucursal $invSucursal
     * @return InvZona
     */
    public function setInvSucursal(\ERP\AdminBundle\Entity\InvSucursal $invSucursal = null)
    {
        $this->invSucursal = $invSucursal;

        return $this;
    }

    /**
     * Get invSucursal
     *
     * @return \ERP\AdminBundle\Entity\InvSucursal 
     */
    public function getInvSucursal()
    {
        return $this->invSucursal;
    }
    
    public function __toString() {
    //return $this->cargo ? $this->cargo : '';
    return $this->getNombre();
    }
}
