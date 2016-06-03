<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvBarCode
 *
 * @ORM\Table(name="inv_bar_code", indexes={@ORM\Index(name="fk_bar_code_inv_producto1_idx", columns={"inv_producto_id"})})
 * @ORM\Entity
 */
class InvBarCode
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
     * @ORM\Column(name="codigo", type="string", length=45, nullable=true)
     */
    private $codigo;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return InvBarCode
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set invProducto
     *
     * @param \ERP\AdminBundle\Entity\InvProducto $invProducto
     * @return InvBarCode
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
}
