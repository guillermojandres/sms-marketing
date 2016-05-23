<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlSubCategoriaProducto
 *
 * @ORM\Table(name="subcategoriaproducto", indexes={@ORM\Index(name="fk_subCategoriaProducto_categoriaProducto1_idx", columns={"idCategoriaProducto"})})
 * @ORM\Entity
 */
class CtlSubCategoriaProducto
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
    private $nombreSubCategoria;

    /**
     * @var \CtlCategoriaProducto
     *
     * @ORM\ManyToOne(targetEntity="CtlCategoriaProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoriaProducto", referencedColumnName="id")
     * })
     */
    private $idCategoria;



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
     * Set nombreSubCategoria
     *
     * @param string $nombreSubCategoria
     * @return CtlCiudad
     */
    public function setNombreSubCategoria($nombreSubCategoria)
    {
        $this->nombreCiudad = $nombreSubCategoria;

        return $this;
    }

    /**
     * Get nombreSubCategoria
     *
     * @return string 
     */
    public function getNombreSubCategoria()
    {
        return $this->nombreSubCategoria;
    }

    /**
     * Set idCategoria
     *
     * @param \ERP\AdminBundle\Entity\CtlCategoriaProducto $idCategoria
     * @return CtlSubCategoriaProducto
     */
    public function setCategoriaProducto(\ERP\AdminBundle\Entity\CtlCategoriaProducto $idCategoria = null)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return \ERP\AdminBundle\Entity\CtlCategoriaProducto 
     */
    public function getCategoriaProducto()
    {
        return $this->idCategoria;
    }
    public function __toString() {
   return $this->nombreSubCategoria;
}
}
