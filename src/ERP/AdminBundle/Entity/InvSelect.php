<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvSelect
 *
 * @ORM\Table(name="inv_select", indexes={@ORM\Index(name="fk_inv_select_inv_atributo_personalizado_idx", columns={"inv_atributo_personalizado_id"})})
 * @ORM\Entity
 */
class InvSelect
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
     * @var \InvAtributoPersonalizado
     *
     * @ORM\ManyToOne(targetEntity="InvAtributoPersonalizado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_atributo_personalizado_id", referencedColumnName="id")
     * })
     */
    private $invAtributoPersonalizado;



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
     * @return InvSelect
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
     * Set invAtributoPersonalizado
     *
     * @param \ERP\AdminBundle\Entity\InvAtributoPersonalizado $invAtributoPersonalizado
     * @return InvSelect
     */
    public function setInvAtributoPersonalizado(\ERP\AdminBundle\Entity\InvAtributoPersonalizado $invAtributoPersonalizado = null)
    {
        $this->invAtributoPersonalizado = $invAtributoPersonalizado;

        return $this;
    }

    /**
     * Get invAtributoPersonalizado
     *
     * @return \ERP\AdminBundle\Entity\InvAtributoPersonalizado 
     */
    public function getInvAtributoPersonalizado()
    {
        return $this->invAtributoPersonalizado;
    }
}
