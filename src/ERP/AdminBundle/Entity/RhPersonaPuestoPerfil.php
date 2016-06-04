<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhPersonaPuestoPerfil
 *
 * @ORM\Table(name="rh_persona_puesto_perfil", indexes={@ORM\Index(name="fk_personal_puesto_perfil_puesto_persona1_idx", columns={"rh_persona_id"}), @ORM\Index(name="fk_personal_puesto_perfil_puesto_puesto_perfil1_idx", columns={"rh_puesto_perfil_id"})})
 * @ORM\Entity
 */
class RhPersonaPuestoPerfil
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var \RhPersona
     *
     * @ORM\ManyToOne(targetEntity="RhPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_persona_id", referencedColumnName="id")
     * })
     */
    private $rhPersona;

    /**
     * @var \RhPuestoPerfil
     *
     * @ORM\ManyToOne(targetEntity="RhPuestoPerfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_puesto_perfil_id", referencedColumnName="id")
     * })
     */
    private $rhPuestoPerfil;



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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return RhPersonaPuestoPerfil
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return RhPersonaPuestoPerfil
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set rhPersona
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersona
     * @return RhPersonaPuestoPerfil
     */
    public function setRhPersona(\ERP\AdminBundle\Entity\RhPersona $rhPersona = null)
    {
        $this->rhPersona = $rhPersona;

        return $this;
    }

    /**
     * Get rhPersona
     *
     * @return \ERP\AdminBundle\Entity\RhPersona 
     */
    public function getRhPersona()
    {
        return $this->rhPersona;
    }

    /**
     * Set rhPuestoPerfil
     *
     * @param \ERP\AdminBundle\Entity\RhPuestoPerfil $rhPuestoPerfil
     * @return RhPersonaPuestoPerfil
     */
    public function setRhPuestoPerfil(\ERP\AdminBundle\Entity\RhPuestoPerfil $rhPuestoPerfil = null)
    {
        $this->rhPuestoPerfil = $rhPuestoPerfil;

        return $this;
    }

    /**
     * Get rhPuestoPerfil
     *
     * @return \ERP\AdminBundle\Entity\RhPuestoPerfil 
     */
    public function getRhPuestoPerfil()
    {
        return $this->rhPuestoPerfil;
    }
}
