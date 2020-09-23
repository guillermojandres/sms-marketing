<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Restaurante
 *
 * @ORM\Table(name="cliente")
 * @ORM\Entity
 */
class Cliente
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
     * @ORM\Column(name="telefono", type="string", length=25, nullable=false)
     */
    private $telefono;

   
    /**
     * @var integer
     * @ORM\Column(name="estado", type="integer", nullable=false) 
     */
    private $estado;

    /**
     * @var date
     * @ORM\Column(name="fecha_insercion", type="date", nullable=false) 
     */
    private $fechaInsercion;
    /**
     * @var date
     * @ORM\Column(name="fecha_modificacion", type="date", nullable=false) 
     */
    private $fechaModificacion;

    /**
     * @var date
     * @ORM\Column(name="fecha_baja", type="date", nullable=false) 
     */
    private $fechaBaja;


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
     * Set fecha_insercion
     *
     * @param string $fecha_insercion
     * @return Restaurante
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fecha_insercion
     *
     * @return integer 
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

   

    
    
    
}
