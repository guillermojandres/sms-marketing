<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvTipoAtributo
 *
 * @ORM\Table(name="inv_tipo_atributo")
 * @ORM\Entity
 */
class InvTipoAtributo
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
     * @var boolean
     *
     * @ORM\Column(name="multiple", type="boolean", nullable=false)
     */
    private $multiple;



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
     * @return InvTipoAtributo
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
     * Set multiple
     *
     * @param boolean $multiple
     * @return InvTipoAtributo
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Get multiple
     *
     * @return boolean 
     */
    public function getMultiple()
    {
        return $this->multiple;
    }
}
