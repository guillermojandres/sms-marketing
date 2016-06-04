<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * InvFotoProducto
 *
 * @ORM\Table(name="inv_foto_producto", indexes={@ORM\Index(name="fk_inv_foto_producto_inv_producto1_idx", columns={"inv_producto_id"})})
 * @ORM\Entity
 */
class InvFotoProducto
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
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;
    
    /**
     * @var \InvProducto
     *
     * @ORM\ManyToOne(targetEntity="InvProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inv_producto_id", referencedColumnName="id")
     * })
     */
    private $invProducto;
    
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
     * @return InvFotoProducto
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
     * Set invProducto
     *
     * @param \ERP\AdminBundle\Entity\InvProducto $invProducto
     * @return InvFotoProducto
     */
    public function setInvProducto(\ERP\AdminBundle\Entity\InvProducto $invProducto = null)
    {
        $this->invProducto = $invProducto;

        return $this;
    }

    /**
     * Get invProducto
     *
     * @return \ERP\AdminBundle\Entity\InvProducto 
     */
    public function getInvProducto()
    {
        return $this->invProducto;
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
