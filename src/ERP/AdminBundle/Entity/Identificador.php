<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Identificador
 *
 * @ORM\Table(name="restaurante_identificadores", indexes={@ORM\Index(name="fk_restaurante_identificadores_restaurante1", columns={"restaurante_id"})})
 * @ORM\Entity
 */
class Identificador
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
     * @ORM\Column(name="serie", type="string", length=80, nullable=false)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="incentivo", type="string", length=250, nullable=false)
     */
    private $incentivo;
    
    /**
     * @var integer
     * @ORM\Column(name="estado", type="integer", nullable=false) 
     */
    private $estado;

     /**
     * @var \Restaurante
     *
     * @ORM\ManyToOne(targetEntity="Restaurante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="restaurante_id", referencedColumnName="id")
     * })
     */
    private $restauranteId;


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
     * @return Contacto
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Restaurante
     */
    public function setIncentivo($incentivo)
    {
        $this->incentivo = $incentivo;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getIncentivo()
    {
        return $this->incentivo;
    }

     
    /**
     * Set estado
     *
     * @param string $estado
     * @return Restaurante
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    /**
     * Set clienteId
     *
     * @param \ERP\AdminBundle\Entity\Restaurante $restauranteId
     * @return Restaurante
     */
    public function setRestauranteId(\ERP\AdminBundle\Entity\Restaurante  $restauranteId = null)
    {
        $this->restauranteId = $restauranteId;

        return $this;
    }

    /**
     * Get clienteId
     *
     * @return \ERP\AdminBundle\Entity\Restaurante $restauranteId
     */
    public function getRestauranteId()
    {
        return $this->restauranteId;
    }  
    
    
   
    public function __toString() {
        
         return $this->sirie;
    }  
    
    
    
    
}
