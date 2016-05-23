<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhExperienciaLaboral
 *
 * @ORM\Table(name="rh_experiencia_laboral", indexes={@ORM\Index(name="fk_experiencia_laboral_persona1_idx", columns={"rh_persona_id"})})
 * @ORM\Entity
 */
class RhExperienciaLaboral
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
     * @ORM\Column(name="compania", type="string", length=45, nullable=false)
     */
    private $compania;

    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", length=45, nullable=false)
     */
    private $puesto;

    /**
     * @var string
     *
     * @ORM\Column(name="salario", type="string", length=45, nullable=false)
     */
    private $salario;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto", type="string", length=45, nullable=false)
     */
    private $contacto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="facha_inicio", type="date", nullable=false)
     */
    private $fachaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_", type="string", length=45, nullable=false)
     */
    private $telefono;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set compania
     *
     * @param string $compania
     * @return RhExperienciaLaboral
     */
    public function setCompania($compania)
    {
        $this->compania = $compania;

        return $this;
    }

    /**
     * Get compania
     *
     * @return string 
     */
    public function getCompania()
    {
        return $this->compania;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     * @return RhExperienciaLaboral
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return string 
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set salario
     *
     * @param string $salario
     * @return RhExperienciaLaboral
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;

        return $this;
    }

    /**
     * Get salario
     *
     * @return string 
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     * @return RhExperienciaLaboral
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return string 
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set fachaInicio
     *
     * @param \DateTime $fachaInicio
     * @return RhExperienciaLaboral
     */
    public function setFachaInicio($fachaInicio)
    {
        $this->fachaInicio = $fachaInicio;

        return $this;
    }

    /**
     * Get fachaInicio
     *
     * @return \DateTime 
     */
    public function getFachaInicio()
    {
        return $this->fachaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return RhExperienciaLaboral
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
     * Set telefono
     *
     * @param string $telefono
     * @return RhExperienciaLaboral
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
     * Set rhPersona
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersona
     * @return RhExperienciaLaboral
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
}
