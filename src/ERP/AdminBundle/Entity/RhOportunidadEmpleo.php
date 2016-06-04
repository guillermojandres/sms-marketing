<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhOportunidadEmpleo
 *
 * @ORM\Table(name="rh_oportunidad_empleo", indexes={@ORM\Index(name="fk_rh_oportunidad_empleo_rh_puesto_perfil1_idx", columns={"rh_puesto_perfil_id"})})
 * @ORM\Entity
 */
class RhOportunidadEmpleo
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
     * @ORM\Column(name="titulo_empleo", type="string", length=45, nullable=false)
     */
    private $tituloEmpleo;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=450, nullable=true)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="publicar", type="boolean", nullable=true)
     */
    private $publicar;

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
     * Set tituloEmpleo
     *
     * @param string $tituloEmpleo
     * @return RhOportunidadEmpleo
     */
    public function setTituloEmpleo($tituloEmpleo)
    {
        $this->tituloEmpleo = $tituloEmpleo;

        return $this;
    }

    /**
     * Get tituloEmpleo
     *
     * @return string 
     */
    public function getTituloEmpleo()
    {
        return $this->tituloEmpleo;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return RhOportunidadEmpleo
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return RhOportunidadEmpleo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set publicar
     *
     * @param boolean $publicar
     * @return RhOportunidadEmpleo
     */
    public function setPublicar($publicar)
    {
        $this->publicar = $publicar;

        return $this;
    }

    /**
     * Get publicar
     *
     * @return boolean 
     */
    public function getPublicar()
    {
        return $this->publicar;
    }

    /**
     * Set rhPuestoPerfil
     *
     * @param \ERP\AdminBundle\Entity\RhPuestoPerfil $rhPuestoPerfil
     * @return RhOportunidadEmpleo
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
