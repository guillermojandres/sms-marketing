<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhGasto
 *
 * @ORM\Table(name="rh_gasto", indexes={@ORM\Index(name="fk_gasto_persona1_idx", columns={"rh_persona_empleado_id"}), @ORM\Index(name="fk_gasto_persona2_idx", columns={"rh_persona_supervisor_id"})})
 * @ORM\Entity
 */
class RhGasto
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
     * @ORM\Column(name="fecha_cotizacion", type="string", length=45, nullable=false)
     */
    private $fechaCotizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio_fiscal", type="integer", nullable=false)
     */
    private $anioFiscal;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=325, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="proyecto", type="string", length=50, nullable=true)
     */
    private $proyecto;

    /**
     * @var string
     *
     * @ORM\Column(name="tarea", type="string", length=45, nullable=true)
     */
    private $tarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_registro", type="string", length=45, nullable=false)
     */
    private $fechaRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var \RhPersona
     *
     * @ORM\ManyToOne(targetEntity="RhPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_persona_empleado_id", referencedColumnName="id")
     * })
     */
    private $rhPersonaEmpleado;

    /**
     * @var \RhPersona
     *
     * @ORM\ManyToOne(targetEntity="RhPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_persona_supervisor_id", referencedColumnName="id")
     * })
     */
    private $rhPersonaSupervisor;



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
     * Set fechaCotizacion
     *
     * @param string $fechaCotizacion
     * @return RhGasto
     */
    public function setFechaCotizacion($fechaCotizacion)
    {
        $this->fechaCotizacion = $fechaCotizacion;

        return $this;
    }

    /**
     * Get fechaCotizacion
     *
     * @return string 
     */
    public function getFechaCotizacion()
    {
        return $this->fechaCotizacion;
    }

    /**
     * Set anioFiscal
     *
     * @param integer $anioFiscal
     * @return RhGasto
     */
    public function setAnioFiscal($anioFiscal)
    {
        $this->anioFiscal = $anioFiscal;

        return $this;
    }

    /**
     * Get anioFiscal
     *
     * @return integer 
     */
    public function getAnioFiscal()
    {
        return $this->anioFiscal;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return RhGasto
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set proyecto
     *
     * @param string $proyecto
     * @return RhGasto
     */
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return string 
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Set tarea
     *
     * @param string $tarea
     * @return RhGasto
     */
    public function setTarea($tarea)
    {
        $this->tarea = $tarea;

        return $this;
    }

    /**
     * Get tarea
     *
     * @return string 
     */
    public function getTarea()
    {
        return $this->tarea;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return RhGasto
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set fechaRegistro
     *
     * @param string $fechaRegistro
     * @return RhGasto
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return string 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return RhGasto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set rhPersonaEmpleado
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersonaEmpleado
     * @return RhGasto
     */
    public function setRhPersonaEmpleado(\ERP\AdminBundle\Entity\RhPersona $rhPersonaEmpleado = null)
    {
        $this->rhPersonaEmpleado = $rhPersonaEmpleado;

        return $this;
    }

    /**
     * Get rhPersonaEmpleado
     *
     * @return \ERP\AdminBundle\Entity\RhPersona 
     */
    public function getRhPersonaEmpleado()
    {
        return $this->rhPersonaEmpleado;
    }

    /**
     * Set rhPersonaSupervisor
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersonaSupervisor
     * @return RhGasto
     */
    public function setRhPersonaSupervisor(\ERP\AdminBundle\Entity\RhPersona $rhPersonaSupervisor = null)
    {
        $this->rhPersonaSupervisor = $rhPersonaSupervisor;

        return $this;
    }

    /**
     * Get rhPersonaSupervisor
     *
     * @return \ERP\AdminBundle\Entity\RhPersona 
     */
    public function getRhPersonaSupervisor()
    {
        return $this->rhPersonaSupervisor;
    }
}
