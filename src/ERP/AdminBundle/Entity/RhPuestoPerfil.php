<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhPuestoPerfil
 *
 * @ORM\Table(name="rh_puesto_perfil", indexes={@ORM\Index(name="fk_perfil_puesto_departamento_empresa1_idx", columns={"ctl_departamento_empresa_id"})})
 * @ORM\Entity
 */
class RhPuestoPerfil
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
     * @ORM\Column(name="profesion", type="string", length=45, nullable=false)
     */
    private $profesion;

    /**
     * @var integer
     *
     * @ORM\Column(name="experiencia", type="integer", nullable=false)
     */
    private $experiencia;

    /**
     * @var string
     *
     * @ORM\Column(name="conocimientos", type="string", length=45, nullable=false)
     */
    private $conocimientos;

    /**
     * @var string
     *
     * @ORM\Column(name="habilidades", type="string", length=45, nullable=false)
     */
    private $habilidades;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_puesto", type="string", length=45, nullable=false)
     */
    private $nombrePuesto;

    /**
     * @var \CtlDepartamentoEmpresa
     *
     * @ORM\ManyToOne(targetEntity="CtlDepartamentoEmpresa")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ctl_departamento_empresa_id", referencedColumnName="id")
     * })
     */
    private $ctlDepartamentoEmpresa;



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
     * Set profesion
     *
     * @param string $profesion
     * @return RhPuestoPerfil
     */
    public function setProfesion($profesion)
    {
        $this->profesion = $profesion;

        return $this;
    }

    /**
     * Get profesion
     *
     * @return string 
     */
    public function getProfesion()
    {
        return $this->profesion;
    }

    /**
     * Set experiencia
     *
     * @param integer $experiencia
     * @return RhPuestoPerfil
     */
    public function setExperiencia($experiencia)
    {
        $this->experiencia = $experiencia;

        return $this;
    }

    /**
     * Get experiencia
     *
     * @return integer 
     */
    public function getExperiencia()
    {
        return $this->experiencia;
    }

    /**
     * Set conocimientos
     *
     * @param string $conocimientos
     * @return RhPuestoPerfil
     */
    public function setConocimientos($conocimientos)
    {
        $this->conocimientos = $conocimientos;

        return $this;
    }

    /**
     * Get conocimientos
     *
     * @return string 
     */
    public function getConocimientos()
    {
        return $this->conocimientos;
    }

    /**
     * Set habilidades
     *
     * @param string $habilidades
     * @return RhPuestoPerfil
     */
    public function setHabilidades($habilidades)
    {
        $this->habilidades = $habilidades;

        return $this;
    }

    /**
     * Get habilidades
     *
     * @return string 
     */
    public function getHabilidades()
    {
        return $this->habilidades;
    }

    /**
     * Set nombrePuesto
     *
     * @param string $nombrePuesto
     * @return RhPuestoPerfil
     */
    public function setNombrePuesto($nombrePuesto)
    {
        $this->nombrePuesto = $nombrePuesto;

        return $this;
    }

    /**
     * Get nombrePuesto
     *
     * @return string 
     */
    public function getNombrePuesto()
    {
        return $this->nombrePuesto;
    }

    /**
     * Set ctlDepartamentoEmpresa
     *
     * @param \ERP\AdminBundle\Entity\CtlDepartamentoEmpresa $ctlDepartamentoEmpresa
     * @return RhPuestoPerfil
     */
    public function setCtlDepartamentoEmpresa(\ERP\AdminBundle\Entity\CtlDepartamentoEmpresa $ctlDepartamentoEmpresa = null)
    {
        $this->ctlDepartamentoEmpresa = $ctlDepartamentoEmpresa;

        return $this;
    }

    /**
     * Get ctlDepartamentoEmpresa
     *
     * @return \ERP\AdminBundle\Entity\CtlDepartamentoEmpresa 
     */
    public function getCtlDepartamentoEmpresa()
    {
        return $this->ctlDepartamentoEmpresa;
    }
}
