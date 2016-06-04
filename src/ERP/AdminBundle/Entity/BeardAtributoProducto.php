<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BeardAtributoProducto
 *
 * @ORM\Table(name="atributoproducto")
 * @ORM\Entity
 */
class BeardAtributoProducto
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
     * @ORM\Column(name="porcentaje", type="string", nullable=false)
     */
    private $porcentaje;
                            
    /**
    * @var \BeardProducto
    *
    * @ORM\ManyToOne(targetEntity="BeardProducto")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="idProducto", referencedColumnName="id")
    * })
    */
    private $idProducto;            
    
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
     * @return BeardAtributoProducto
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
     * Set porcentaje
     *
     * @param string $porcentaje
     * @return BeardProducto
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return string
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }                  
                               
    
            
    /**
     * Set idProducto
     *
     * @param \ERP\AdminBundle\Entity\BeardProducto  $idProducto
     * @return BeardProducto
     */
    public function setIdProducto(\ERP\AdminBundle\Entity\BeardProducto $idProducto = null)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return \ERP\AdminBundle\Entity\BeardProducto 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
        
    public function __toString() {
        return $this->nombreCategoria;
    }
    
}