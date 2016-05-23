<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmComunicacion
 *
 * @ORM\Table(name="crm_comunicacion", indexes={@ORM\Index(name="fk_comunicacion_estado_comunicacion1_idx", columns={"estado_comunicacion_id"})})
 * @ORM\Entity
 */
class CrmComunicacion
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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="comunicacioncol", type="string", length=45, nullable=true)
     */
    private $comunicacioncol;

    /**
     * @var \CrmEstadoComunicacion
     *
     * @ORM\ManyToOne(targetEntity="CrmEstadoComunicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_comunicacion_id", referencedColumnName="id")
     * })
     */
    private $estadoComunicacion;



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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return CrmComunicacion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set comunicacioncol
     *
     * @param string $comunicacioncol
     * @return CrmComunicacion
     */
    public function setComunicacioncol($comunicacioncol)
    {
        $this->comunicacioncol = $comunicacioncol;

        return $this;
    }

    /**
     * Get comunicacioncol
     *
     * @return string 
     */
    public function getComunicacioncol()
    {
        return $this->comunicacioncol;
    }

    /**
     * Set estadoComunicacion
     *
     * @param \ERP\AdminBundle\Entity\CrmEstadoComunicacion $estadoComunicacion
     * @return CrmComunicacion
     */
    public function setEstadoComunicacion(\ERP\AdminBundle\Entity\CrmEstadoComunicacion $estadoComunicacion = null)
    {
        $this->estadoComunicacion = $estadoComunicacion;

        return $this;
    }

    /**
     * Get estadoComunicacion
     *
     * @return \ERP\AdminBundle\Entity\CrmEstadoComunicacion 
     */
    public function getEstadoComunicacion()
    {
        return $this->estadoComunicacion;
    }
}
