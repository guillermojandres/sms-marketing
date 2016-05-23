<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BeardImagenProducto
 *
 * @ORM\Table(name="imagenproducto")
 * @ORM\Entity
 */
class BeardImagenProducto
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
     * @ORM\Column(name="imagen1", type="string", length=255, nullable=false)
     */
    private $imagen1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagen2", type="string", length=255, nullable=false)
     */
    private $imagen2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagen3", type="string", length=255, nullable=false)
     */
    private $imagen3;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagen4", type="string", length=255, nullable=false)
     */
    private $imagen4;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagen5", type="string", length=255, nullable=false)
     */
    private $imagen5;

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
     * Set imagen1
     *
     * @param string $imagen1
     * @return BeardImagenProducto
     */
    public function setImagen1($imagen1)
    {
        $this->imagen1 = $imagen1;

        return $this;
    }

    /**
     * Get imagen1
     *
     * @return string 
     */
    public function getImagen1()
    {
        return $this->imagen1;
    }
    
     /**
     * Set imagen2
     *
     * @param string $imagen2
     * @return BeardImagenProducto
     */
    public function setImagen2($imagen2) {
        $this->imagen2 = $imagen2;

        return $this;
    }

    /**
     * Get imagen2
     *
     * @return string 
     */
    public function getImagen2() {
        return $this->imagen2;
    }
    
    
    /**
    * Set imagen3
    *
    * @param string $imagen3
    * @return BeardImagenProducto
    */
    public function setImagen3($imagen3) {
    $this->imagen3 = $imagen3;

    return $this;
    }

    /**
     * Get imagen3
     *
     * @return string 
     */
    public function getImagen3() {
    return $this->imagen3;
    }
    
     /**
     * Set imagen4
     *
     * @param string $imagen4
     * @return BeardImagenProducto
     */
    public function setImagen4($imagen4) {
        $this->imagen4 = $imagen4;

        return $this;
    }

    /**
     * Get imagen4
     *
     * @return string 
     */
    public function getImagen4() {
        return $this->imagen4;
    }
    
     /**
     * Set imagen5
     *
     * @param string $imagen5
     * @return BeardImagenProducto
     */
    public function setImagen5($imagen5) {
        $this->imagen5 = $imagen5;

        return $this;
    }

    /**
     * Get imagen5
     *
     * @return string 
     */
    public function getImagen5() {
        return $this->imagen5;
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