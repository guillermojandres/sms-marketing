<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Mensajes
 *
 * @ORM\Table(name="mensaje", indexes={@ORM\Index(name="fk_mensaje_restaurante1", columns={"restaurante_id"})})
 * @ORM\Entity
 */
class Mensaje
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
     * @ORM\Column(name="titulo", type="string", length=45, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="string", length=160, nullable=false)
     */
    private $texto;

    /**
     * @var Time
     *
     * @ORM\Column(name="hora_envio", type="time", nullable=true)
     */
    private $horaEnvio;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="fecha_insercion", type="date", nullable=true)
     */
    private $fechaInsercion;
      /**
     * @var DateTime
     *
     * @ORM\Column(name="fecha_envio", type="date", nullable=true)
     */
    private $fechaEnvio;
    /**
     * @var DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="date", nullable=true)
     */
    private $fechaModificacion;

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
     * @var integer
     * @ORM\Column(name="estado", type="integer", nullable=false) 
     */
    private $estado;
         /**
     * @var integer
     * @ORM\Column(name="estado_envio", type="integer", nullable=false) 
     */
    private $estadoEnvio;


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
     * Set titulo
     *
     * @param string $titulo
     * @return 
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Restaurante
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
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
     * Set hora_envio
     *
     * @param string $hora_envio
     * @return Restaurante
     */
    public function setHoraEnvio($hora_envio)
    {
        $this->horaEnvio = $hora_envio;

        return $this;
    }

    /**
     * Get fecha_insercion
     *
     * @return time 
     */
    public function getHoraEnvio()
    {
        return $this->horaEnvio;
    }




    /**
     * Set fecha_insercion
     *
     * @param string $fecha_insercion
     * @return Restaurante
     */
    public function setFechaInsercion($fecha_insercion)
    {
        $this->fechaInsercion = $fecha_insercion;

        return $this;
    }

    /**
     * Get fecha_insercion
     *
     * @return integer 
     */
    public function getFechaInsercion()
    {
        return $this->fechaInsercion;
    }



    /**
     * Set fecha_insercion
     *
     * @param string $fecha_insercion
     * @return Restaurante
     */
    public function setFechaEnvio($fecha_envio)
    {
        $this->fechaEnvio = $fecha_envio;

        return $this;
    }

    /**
     * Get fecha_insercion
     *
     * @return integer 
     */
    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
    }


    /**
     * Set fecha_modificacion
     *
     * @param string $fecha_modificacion
     * @return Restaurante
     */
    public function setFechaModificacion($fecha_modificacion)
    {
        $this->fechaModificacion = $fecha_modificacion;

        return $this;
    }

    /**
     * Get fecha_modificacion
     *
     * @return integer 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
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
        
         return $this->titulo;
    }  



    /**
     * Set estado
     *
     * @param string $estado
     * @return Restaurante
     */
    public function setEstadoEnvio($estadoEnvio)
    {
        $this->estadoEnvio = $estadoEnvio;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstadoEnvio()
    {
        return $this->estadoEnvio;
    }
    
    
    
    
}
