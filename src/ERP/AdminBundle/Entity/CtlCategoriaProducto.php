<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlCategoriaProducto
 *
 * @ORM\Table(name="categoriaproducto")
 * @ORM\Entity
 */
class CtlCategoriaProducto
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombreCategoria;

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
     * Set nombreCategoriaProducto
     *
     * @param string $nombreCategoriaProducto
     * @return CtlCategoriaProducto
     */
    public function setNombreCategoriaProducto($nombreCategoriaProducto)
    {
        $this->nombreCiudad = $nombreCategoriaProducto;

        return $this;
    }

    /**
     * Get nombreCategoriaProducto
     *
     * @return string 
     */
    public function getNombreCategoria()
    {
        return $this->nombreCategoria;
    }
   
    public function __toString() {
    return $this->nombreCategoria;
}
}
