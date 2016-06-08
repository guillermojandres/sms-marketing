<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orden
 *
 * @ORM\Table(name="orden", indexes={@ORM\Index(name="fk_orden_encabezado_orden1", columns={"encabezado_orden_id"}), @ORM\Index(name="fk_producto_orden1", columns={"id_producto"})})
 * @ORM\Entity
 */
class Orden
{
    /**
     * @var bigint
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    
     /**
     * @var integer
     *
     * @ORM\Column(name="cookie", type="integer", nullable=false)
     */
    private $cookie;
    
    
     /**
     * @var decimal
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     */
    private $precio;
    
    
     
     /**
     * @var decimal
     *
     * @ORM\Column(name="descuento", type="float", nullable=false)
     */
    private $descuento;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_prod", type="string", length=500, nullable=true)
     */
    private $nombreProd;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="idProducto", type="integer", nullable=false)
     */
    private $idProducto;
    
     /**
     * @var string
     *
     * @ORM\Column(name="numero_referencia", type="string", length=30, nullable=true)
     */
    private $numeroReferencia;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=true)
     */
    private $fechaRegistro;

  /**
     * @var \EncabezadoOrden
     *
     * @ORM\ManyToOne(targetEntity="EncabezadoOrden")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encabezado_orden_id", referencedColumnName="id")
     * })
     */
    private $encabezadoOrdenId;
    
   
    
     /**
     * @var \BeardProducto
     *
     * @ORM\ManyToOne(targetEntity="BeardProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_producto", referencedColumnName="id")
     * })
     */
    private $productoId;

    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

   
    /**
     * Set encabezadoOrdenId
     *
     * @param \ERP\AdminBundle\Entity\EncabezadoOrden $encabezadoOrdenId
     * @return EncabezadoOrden
     */
    public function setEncabezadoOrden(\ERP\AdminBundle\Entity\EncabezadoOrden  $encabezadoOrdenId = null)
    {
        $this->encabezadoOrdenId = $encabezadoOrdenId;

        return $this;
    }

    /**
     * Get encabezadoOrdenId
     *
     * @return \ERP\AdminBundle\Entity\EncabezadoOrden $encabezadoOrdenId
     */
    public function getEncabezadoOrden()
    {
        return $this->encabezadoOrdenId;
    }  
    
    
    
    
    
   
    /**
     * Set estado
     *
     * @param tinyint $estado
     * @return Orden
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
     * Set cookie
     *
     * @param integer $cookie
     * @return Orden
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;

        return $this;
    }

    /**
     * Get cookie
     *
     * @return integer 
     */
    public function getCookie()
    {
        return $this->cookie;
    }
    
    /**
     * Set nombreProd
     *
     * @param string $nombreProd
     * @return Orden
     */
    public function setNombreProd($nombreProd)
    {
        $this->nombreProd = $nombreProd;

        return $this;
    }

    /**
     * Get nombreProd
     *
     * @return string 
     */
    public function getNombreProd()
    {
        return $this->nombreProd;
    }
    
      /**
     * Set precio
     *
     * @param decimal $precio
     * @return Orden
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return decimal 
     */
    public function getPrecio()
    {
        return $this->precio;
    }
    
    
    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Orden
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
    
  
    
    /**
     * Set idProducto
     *
     * @param integer $idProducto
     * @return Orden
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return integer 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    
    /**
     * Set numeroReferencia
     *
     * @param string $numeroReferencia
     * @return Orden
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
     * Set imagen
     *
     * @param string $imagen
     * @return Orden
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

     /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }
    
     /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return RegistroPorProyecto
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }
    
     /**
     * Set descuento
     *
     * @param decimal $descuento
     * @return Orden
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return decimal 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }
    
    
    
     /**
     * Set productoId
     *
     * @param \ERP\AdminBundle\Entity\BeardProducto $productoId
     * @return BeardProducto
     */
    public function setProductoId(\ERP\AdminBundle\Entity\BeardProducto  $productoId = null)
    {
        $this->productoId = $productoId;

        return $this;
    }

    /**
     * Get productoId
     *
     * @return \ERP\AdminBundle\Entity\BeardProducto $productoId
     */
    public function getProductoId()
    {
        return $this->productoId;
    }  
    
    
    
    
}
