<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhFormacionAcademica
 *
 * @ORM\Table(name="rh_formacion_academica", indexes={@ORM\Index(name="fk_formacion_academica_persona1_idx", columns={"rh_persona_id"})})
 * @ORM\Entity
 */
class RhFormacionAcademica
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
     * @ORM\Column(name="institucion", type="string", length=45, nullable=false)
     */
    private $institucion;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="string", length=45, nullable=false)
     */
    private $nivel;

    /**
     * @var string
     *
     * @ORM\Column(name="anio_graduacion", type="string", length=45, nullable=false)
     */
    private $anioGraduacion;

    /**
     * @var string
     *
     * @ORM\Column(name="calificacion", type="string", length=45, nullable=false)
     */
    private $calificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=45, nullable=false)
     */
    private $titulo;

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
     * Set institucion
     *
     * @param string $institucion
     * @return RhFormacionAcademica
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string 
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set nivel
     *
     * @param string $nivel
     * @return RhFormacionAcademica
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string 
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set anioGraduacion
     *
     * @param string $anioGraduacion
     * @return RhFormacionAcademica
     */
    public function setAnioGraduacion($anioGraduacion)
    {
        $this->anioGraduacion = $anioGraduacion;

        return $this;
    }

    /**
     * Get anioGraduacion
     *
     * @return string 
     */
    public function getAnioGraduacion()
    {
        return $this->anioGraduacion;
    }

    /**
     * Set calificacion
     *
     * @param string $calificacion
     * @return RhFormacionAcademica
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return string 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return RhFormacionAcademica
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
     * Set rhPersona
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersona
     * @return RhFormacionAcademica
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
