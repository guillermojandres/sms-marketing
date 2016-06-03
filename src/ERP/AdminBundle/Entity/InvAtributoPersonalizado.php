<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvAtributoPersonalizado
 *
 * @ORM\Table(name="inv_atributo_personalizado", indexes={@ORM\Index(name="fk_inv_atributo_personalizado_inv_producto_inv_idx", columns={"inv_producto_id"}), @ORM\Index(name="fk_inv_atributo_personalizado_inv_tipo_producto_idx", columns={"inv_tipo_atributo_id"})})
 * @ORM\Entity
 */
class InvAtributoPersonalizado
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
     * @ORM\Column(name="alias", type="string", length=50, nullable=false)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=50, nullable=false)
     */
    private $valor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var \InvProducto
     *
     * @ORM\ManyToOne(targetEntity="InvProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_producto_id", referencedColumnName="id")
     * })
     */
    private $invProducto;

    /**
     * @var \InvTipoAtributo
     *
     * @ORM\ManyToOne(targetEntity="InvTipoAtributo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_tipo_atributo_id", referencedColumnName="id")
     * })
     */
    private $invTipoAtributo;



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
     * @return InvAtributoPersonalizado
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
     * @return InvAtributoPersonalizado
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
     * Set valor
     *
     * @param string $valor
     * @return InvAtributoPersonalizado
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return InvAtributoPersonalizado
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
     * Set invProducto
     *
     * @param \ERP\AdminBundle\Entity\InvProducto $invProducto
     * @return InvAtributoPersonalizado
     */
    public function setInvProducto(\ERP\AdminBundle\Entity\InvProducto $invProducto = null)
    {
        $this->invProducto = $invProducto;

        return $this;
    }

    /**
     * Get invProducto
     *
     * @return \ERP\AdminBundle\Entity\InvProducto 
     */
    public function getInvProducto()
    {
        return $this->invProducto;
    }

    /**
     * Set invTipoAtributo
     *
     * @param \ERP\AdminBundle\Entity\InvTipoAtributo $invTipoAtributo
     * @return InvAtributoPersonalizado
     */
    public function setInvTipoAtributo(\ERP\AdminBundle\Entity\InvTipoAtributo $invTipoAtributo = null)
    {
        $this->invTipoAtributo = $invTipoAtributo;

        return $this;
    }

    /**
     * Get invTipoAtributo
     *
     * @return \ERP\AdminBundle\Entity\InvTipoAtributo 
     */
    public function getInvTipoAtributo()
    {
        return $this->invTipoAtributo;
    }
}
