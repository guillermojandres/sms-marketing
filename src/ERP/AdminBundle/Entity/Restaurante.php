<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurante
 *
 * @ORM\Table(name="restaurante")
 * @ORM\Entity
 */
class Restaurante
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
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=25, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_contacto", type="string", length=100, nullable=true)
     */
    private $nombreContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=150, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=60, nullable=true)
     */
    private $correo;
     /**
     * @var string
     *
     * @ORM\Column(name="numero_twillio", type="string", length=50, nullable=true)
     */
    private $numeroTwillio;
    
    /**
     * @var integer
     * @ORM\Column(name="estado", type="integer", nullable=false) 
     */
    private $estado;

    /**
     * @var date
     * @ORM\Column(name="fecha_insercion", type="date", nullable=false) 
     */
    private $fecha_insercion;
    /**
     * @var date
     * @ORM\Column(name="fecha_modificacion", type="date", nullable=false) 
     */
    private $fecha_modificacion;


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
     * Set telefono
     *
     * @param string $telefono
     * @return Restaurante
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

     /**
     * Set telefono
     *
     * @param string $nombre_contacto
     * @return Restaurante
     */
    public function setNombreContacto($nombreContacto)
    {
        $this->nombreContacto = $nombreContacto;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getNombreContacto()
    {
        return $this->nombreContacto;
    }

    /**
     * Set correoelectronico
     *
     * @param string $correoelectronico
     * @return Contacto
     */
    public function setCorreo($correo)
    {
        $this->correoe = $correo;

        return $this;
    }

    /**
     * Get correoelectronico
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }


    /**
     * Set correoelectronico
     *
     * @param string $numeroTwillio
     * @return Contacto
     */
    public function setNumeroTwillio($numeroTwillio)
    {
        $this->numeroTwillio = $numeroTwillio;

        return $this;
    }

    /**
     * Get numeroTwillio
     *
     * @return string 
     */
    public function getNumeroTwillio()
    {
        return $this->numeroTwillio;
    }



    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Contacto
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
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
     * Set fecha_insercion
     *
     * @param string $fecha_insercion
     * @return Restaurante
     */
    public function setFechaInsercion($fecha_insercion)
    {
        $this->fecha_insercion = $fecha_insercion;

        return $this;
    }

    /**
     * Get fecha_insercion
     *
     * @return integer 
     */
    public function getFechaInsercion()
    {
        return $this->fecha_insercion;
    }


    /**
     * Set fecha_modificacion
     *
     * @param string $fecha_modificacion
     * @return Restaurante
     */
    public function setFechaModificacion($fecha_modificacion)
    {
        $this->fecha_modificacion = $fecha_modificacion;

        return $this;
    }

    /**
     * Get fecha_modificacion
     *
     * @return integer 
     */
    public function getFechaModificacion()
    {
        return $this->fecha_modificacion;
    }
    
    
   
    public function __toString() {
        
         return $this->nombre;
    }  
    
    
    
    
}
