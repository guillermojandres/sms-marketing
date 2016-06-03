<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BeardProducto
 *
 * @ORM\Table(name="producto")
 * @ORM\Entity
 */
class BeardProducto
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
     * @var float
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     */
    private $precio;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numeroReferencia", type="string", length=100, nullable=false)
     */
    private $numeroReferencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=6000, nullable=false)
     */
    private $descripcion;
    
    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=200, nullable=false)
     */
    private $link;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ingrediente", type="string", length=500, nullable=false)
     */
    private $ingrediente;
    
    /**
     * @var string
     *
     * @ORM\Column(name="presentacion", type="string", length=150, nullable=false)
     */
    private $presentacion;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="destacado", type="integer", nullable=false)
     */
    private $destacado;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="disponible", type="integer", nullable=false)
     */
    private $disponible;
    
    /**
     * @var string
     *
     * @ORM\Column(name="mensaje", type="string", length=200, nullable=false)
     */
    private $mensaje;
    
    /**
    * @var \CtlSubCategoriaProducto
    *
    * @ORM\ManyToOne(targetEntity="CtlSubCategoriaProducto")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="idSubCategoriaProducto", referencedColumnName="id")
    * })
    */
    private $idSubCategoriaProducto;
                      
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
     * @return BeardProducto
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
     * Set precio
     *
     * @param float $precio
     * @return BeardProducto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }
        
    /**
     * Set numeroReferencia
     *
     * @param string $numeroReferencia
     * @return BeardProducto
     */
    public function setNumeroReferencia($numeroReferencia)
    {
        $this->numeroReferencia = $numeroReferencia;

        return $this;
    }

    /**
     * Get numeroReferencia
     *
     * @return string 
     */
    public function getNumeroReferencia()
    {
        return $this->numeroReferencia;
    }
    
    /**
     * Set estado
     *
     * @param boolean $estado
     * @return BeardProducto
     */
    public function setEstado($estado) {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado() {
        return $this->estado;
    }        

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return BeardProducto
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion() {
        return $this->descripcion;
    }
        
    /**
     * Set link
     *
     * @param string $link
     * @return BeardProducto
     */
    public function setLink($link) {
    $this->link = $link;

    return $this;
    }

    /**
     * Get $link
     *
     * @return string 
     */
    public function getLink() {
        return $this->link;
    }
        
    /**
     * Set ingrediente
     *
     * @param string $ingrediente
     * @return BeardProducto
     */
    public function setIngrediente($ingrediente) {
        $this->ingrediente = $ingrediente;

        return $this;
    }

    /**
     * Get ingrediente
     *
     * @return string 
     */
    public function getIngrediente() {
        return $this->ingrediente;
    }
        
    /**
     * Set presentacion
     *
     * @param string $presentacion
     * @return BeardProducto
     */
    public function setPresentacion($presentacion) {
        $this->presentacion = $presentacion;
        return $this;
    }

    /**
     * Get presentacion
     *
     * @return string 
     */
    public function getPresentacion() {
        return $this->presentacion;
    }
        
    /**
     * Set stock
     *
     * @param integer $stock
     * @return BeardProducto
     */
    public function setStock($stock) {
        $this->stock = $stock;
        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock() {
        return $this->stock;
    }
    
    /**
     * Set destacado
     *
     * @param integer $destacado
     * @return BeardProducto
     */
    public function setDestacado($destacado) {
        $this->destacado = $destacado;
        return $this;
    }

    /**
     * Get destacado
     *
     * @return integer 
     */
    public function getDestacado() {
        return $this->destacado;
    }
    
    /**
     * Set disponible
     *
     * @param integer $disponible
     * @return BeardProducto
     */
    public function setDispoonible($disponible) {
        $this->disponible = $disponible;
        return $this;
    }

    /**
     * Get disponible
     *
     * @return integer 
     */
    public function getDisponible() {
        return $this->disponible;
    }
    
    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return BeardProducto
     */
    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
        return $this;
    }

    /**
     * Get 
     *
     * @return string 
     */
    public function getMensaje() {
        return $this->mensaje;
    }

    /**
     * Set idSubCategoriaProducto
     *
     * @param \ERP\AdminBundle\Entity\CtlSubCategoriaProducto  $idSubCategoriaProducto
     * @return CtlSubCategoriaProducto
     */
    public function setSubCategoriaProducto(\ERP\AdminBundle\Entity\CtlSubCategoriaProducto $idSubCategoriaProducto = null)
    {
        $this->idSubCategoriaProducto = $idSubCategoriaProducto;

        return $this;
    }

    /**
     * Get idSubCategoriaProducto
     *
     * @return \ERP\AdminBundle\Entity\CtlSubCategoriaProducto 
     */
    public function getSubCategoriaProducto()
    {
        return $this->idSubCategoriaProducto;
    }
        
    public function __toString() {
        return $this->nombre;
    }
    
}