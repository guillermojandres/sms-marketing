<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * InvProducto
 *
 * @ORM\Table(name="inv_producto", indexes={@ORM\Index(name="fk_inv_producto_inv_zona1_idx", columns={"inv_zona_id"}), @ORM\Index(name="fk_inv_producto_inv_cat_producto1_idx", columns={"inv_cat_producto_id"}), @ORM\Index(name="fk_inv_producto_inv_tipo_inventario1_idx", columns={"inv_tipo_inventario_id"})})
 * @ORM\Entity
 */
class InvProducto
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=500, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_compra", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $precioCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_venta", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $precioVenta;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=100, nullable=true)
     */
    private $sku;

    /**
     * @var string
     *
     * @ORM\Column(name="serial", type="string", length=100, nullable=true)
     */
    private $serial;

    /**
     * @var integer
     *
     * @ORM\Column(name="inventario_bajo", type="integer", nullable=true)
     */
    private $inventarioBajo;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_existencia", type="integer", nullable=true)
     */
    private $totalExistencia;

    /**
     * @var \CltCatProducto
     *
     * @ORM\ManyToOne(targetEntity="CltCatProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_cat_producto_id", referencedColumnName="id")
     * })
     */
    private $invCatProducto;

    /**
     * @var \CtlTipoInventario
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoInventario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_tipo_inventario_id", referencedColumnName="id")
     * })
     */
    private $invTipoInventario;

    /**
     * @var \InvZona
     *
     * @ORM\ManyToOne(targetEntity="InvZona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_zona_id", referencedColumnName="id")
     * })
     */
    private $invZona;
    
    /**
    * @var integer
    * @ORM\Column(name="estado", type="integer", nullable=false) 
    */
    private $estado;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

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
     * @return InvProducto
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return InvProducto
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return InvProducto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precioCompra
     *
     * @param string $precioCompra
     * @return InvProducto
     */
    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;

        return $this;
    }

    /**
     * Get precioCompra
     *
     * @return string 
     */
    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    /**
     * Set precioVenta
     *
     * @param string $precioVenta
     * @return InvProducto
     */
    public function setPrecioVenta($precioVenta)
    {
        $this->precioVenta = $precioVenta;

        return $this;
    }

    /**
     * Get precioVenta
     *
     * @return string 
     */
    public function getPrecioVenta()
    {
        return $this->precioVenta;
    }

    /**
     * Set sku
     *
     * @param string $sku
     * @return InvProducto
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string 
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set serial
     *
     * @param string $serial
     * @return InvProducto
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;

        return $this;
    }

    /**
     * Get serial
     *
     * @return string 
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Set inventarioBajo
     *
     * @param integer $inventarioBajo
     * @return InvProducto
     */
    public function setInventarioBajo($inventarioBajo)
    {
        $this->inventarioBajo = $inventarioBajo;

        return $this;
    }

    /**
     * Get inventarioBajo
     *
     * @return integer 
     */
    public function getInventarioBajo()
    {
        return $this->inventarioBajo;
    }

    /**
     * Set totalExistencia
     *
     * @param integer $totalExistencia
     * @return InvProducto
     */
    public function setTotalExistencia($totalExistencia)
    {
        $this->totalExistencia = $totalExistencia;

        return $this;
    }

    /**
     * Get totalExistencia
     *
     * @return integer 
     */
    public function getTotalExistencia()
    {
        return $this->totalExistencia;
    }

    /**
     * Set invCatProducto
     *
     * @param \ERP\AdminBundle\Entity\CltCatProducto $invCatProducto
     * @return InvProducto
     */
    public function setInvCatProducto(\ERP\AdminBundle\Entity\CltCatProducto $invCatProducto = null)
    {
        $this->invCatProducto = $invCatProducto;

        return $this;
    }

    /**
     * Get invCatProducto
     *
     * @return \ERP\AdminBundle\Entity\CltCatProducto 
     */
    public function getInvCatProducto()
    {
        return $this->invCatProducto;
    }

    /**
     * Set invTipoInventario
     *
     * @param \ERP\AdminBundle\Entity\CtlTipoInventario $invTipoInventario
     * @return InvProducto
     */
    public function setInvTipoInventario(\ERP\AdminBundle\Entity\CtlTipoInventario $invTipoInventario = null)
    {
        $this->invTipoInventario = $invTipoInventario;

        return $this;
    }

    /**
     * Get invTipoInventario
     *
     * @return \ERP\AdminBundle\Entity\CtlTipoInventario 
     */
    public function getInvTipoInventario()
    {
        return $this->invTipoInventario;
    }

    /**
     * Set invZona
     *
     * @param \ERP\AdminBundle\Entity\InvZona $invZona
     * @return InvProducto
     */
    public function setInvZona(\ERP\AdminBundle\Entity\InvZona $invZona = null)
    {
        $this->invZona = $invZona;

        return $this;
    }

    /**
     * Get invZona
     *
     * @return \ERP\AdminBundle\Entity\InvZona 
     */
    public function getInvZona()
    {
        return $this->invZona;
    }
    
    /**
    * Set estado
    *
    * @param string $estado
    * @return Estado
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
    
    public function __toString() {
    //return $this->cargo ? $this->cargo : '';
    return $this->getNombre();
    }
    
     /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
}
