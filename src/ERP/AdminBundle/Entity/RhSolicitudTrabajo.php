<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhSolicitudTrabajo
 *
 * @ORM\Table(name="rh_solicitud_trabajo", indexes={@ORM\Index(name="fk_rh_solicitud_trabajo_rh_oportunidad_empleo1_idx", columns={"rh_oportunidad_empleo_id"})})
 * @ORM\Entity
 */
class RhSolicitudTrabajo
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
     * @ORM\Column(name="nombre_solicitanta", type="string", length=45, nullable=false)
     */
    private $nombreSolicitanta;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=400, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="correoelectronico", type="string", length=45, nullable=false)
     */
    private $correoelectronico;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string", length=100, nullable=true)
     */
    private $src;

    /**
     * @var \RhOportunidadEmpleo
     *
     * @ORM\ManyToOne(targetEntity="RhOportunidadEmpleo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_oportunidad_empleo_id", referencedColumnName="id")
     * })
     */
    private $rhOportunidadEmpleo;



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
     * Set nombreSolicitanta
     *
     * @param string $nombreSolicitanta
     * @return RhSolicitudTrabajo
     */
    public function setNombreSolicitanta($nombreSolicitanta)
    {
        $this->nombreSolicitanta = $nombreSolicitanta;

        return $this;
    }

    /**
     * Get nombreSolicitanta
     *
     * @return string 
     */
    public function getNombreSolicitanta()
    {
        return $this->nombreSolicitanta;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return RhSolicitudTrabajo
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
     * Set observacion
     *
     * @param string $observacion
     * @return RhSolicitudTrabajo
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set correoelectronico
     *
     * @param string $correoelectronico
     * @return RhSolicitudTrabajo
     */
    public function setCorreoelectronico($correoelectronico)
    {
        $this->correoelectronico = $correoelectronico;

        return $this;
    }

    /**
     * Get correoelectronico
     *
     * @return string 
     */
    public function getCorreoelectronico()
    {
        return $this->correoelectronico;
    }

    /**
     * Set src
     *
     * @param string $src
     * @return RhSolicitudTrabajo
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string 
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set rhOportunidadEmpleo
     *
     * @param \ERP\AdminBundle\Entity\RhOportunidadEmpleo $rhOportunidadEmpleo
     * @return RhSolicitudTrabajo
     */
    public function setRhOportunidadEmpleo(\ERP\AdminBundle\Entity\RhOportunidadEmpleo $rhOportunidadEmpleo = null)
    {
        $this->rhOportunidadEmpleo = $rhOportunidadEmpleo;

        return $this;
    }

    /**
     * Get rhOportunidadEmpleo
     *
     * @return \ERP\AdminBundle\Entity\RhOportunidadEmpleo 
     */
    public function getRhOportunidadEmpleo()
    {
        return $this->rhOportunidadEmpleo;
    }
}
