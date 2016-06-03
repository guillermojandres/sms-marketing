<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity
 */
class Empresa
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
     * @ORM\Column(name="emp_nombre", type="string", length=50, nullable=false)
     */
    private $empNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_direccion", type="string", length=200, nullable=false)
     */
    private $empDireccion;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_telefono", type="string", length=12, nullable=false)
     */
    private $empTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_correo", type="string", length=50, nullable=false)
     */
    private $empCorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="emp_fotologo", type="string", length=255, nullable=false)
     */
    private $empFotologo;



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
     * Set empNombre
     *
     * @param string $empNombre
     * @return Empresa
     */
    public function setEmpNombre($empNombre)
    {
        $this->empNombre = $empNombre;

        return $this;
    }

    /**
     * Get empNombre
     *
     * @return string 
     */
    public function getEmpNombre()
    {
        return $this->empNombre;
    }

    /**
     * Set empDireccion
     *
     * @param string $empDireccion
     * @return Empresa
     */
    public function setEmpDireccion($empDireccion)
    {
        $this->empDireccion = $empDireccion;

        return $this;
    }

    /**
     * Get empDireccion
     *
     * @return string 
     */
    public function getEmpDireccion()
    {
        return $this->empDireccion;
    }

    /**
     * Set empTelefono
     *
     * @param string $empTelefono
     * @return Empresa
     */
    public function setEmpTelefono($empTelefono)
    {
        $this->empTelefono = $empTelefono;

        return $this;
    }

    /**
     * Get empTelefono
     *
     * @return string 
     */
    public function getEmpTelefono()
    {
        return $this->empTelefono;
    }

    /**
     * Set empCorreo
     *
     * @param string $empCorreo
     * @return Empresa
     */
    public function setEmpCorreo($empCorreo)
    {
        $this->empCorreo = $empCorreo;

        return $this;
    }

    /**
     * Get empCorreo
     *
     * @return string 
     */
    public function getEmpCorreo()
    {
        return $this->empCorreo;
    }

    /**
     * Set empFotologo
     *
     * @param string $empFotologo
     * @return Empresa
     */
    public function setEmpFotologo($empFotologo)
    {
        $this->empFotologo = $empFotologo;

        return $this;
    }

    /**
     * Get empFotologo
     *
     * @return string 
     */
    public function getEmpFotologo()
    {
        return $this->empFotologo;
    }
}
