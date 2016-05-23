<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhDetalleContacto
 *
 * @ORM\Table(name="rh_detalle_contacto", indexes={@ORM\Index(name="fk_detalle_contacto_persona1_idx", columns={"rh_persona_id"})})
 * @ORM\Entity
 */
class RhDetalleContacto
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
     * @ORM\Column(name="contacto", type="string", length=45, nullable=false)
     */
    private $contacto;

    /**
     * @var string
     *
     * @ORM\Column(name="relacion", type="string", length=45, nullable=false)
     */
    private $relacion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_movil", type="string", length=12, nullable=false)
     */
    private $telefonoMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_fijo", type="string", length=12, nullable=true)
     */
    private $telefonoFijo;

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
     * Set contacto
     *
     * @param string $contacto
     * @return RhDetalleContacto
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
     * Set relacion
     *
     * @param string $relacion
     * @return RhDetalleContacto
     */
    public function setRelacion($relacion)
    {
        $this->relacion = $relacion;

        return $this;
    }

    /**
     * Get relacion
     *
     * @return string 
     */
    public function getRelacion()
    {
        return $this->relacion;
    }

    /**
     * Set telefonoMovil
     *
     * @param string $telefonoMovil
     * @return RhDetalleContacto
     */
    public function setTelefonoMovil($telefonoMovil)
    {
        $this->telefonoMovil = $telefonoMovil;

        return $this;
    }

    /**
     * Get telefonoMovil
     *
     * @return string 
     */
    public function getTelefonoMovil()
    {
        return $this->telefonoMovil;
    }

    /**
     * Set telefonoFijo
     *
     * @param string $telefonoFijo
     * @return RhDetalleContacto
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    /**
     * Get telefonoFijo
     *
     * @return string 
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * Set rhPersona
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersona
     * @return RhDetalleContacto
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
