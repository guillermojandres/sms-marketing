<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhDetalleEmpleo
 *
 * @ORM\Table(name="rh_detalle_empleo", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_detalle_empleado_persona1_idx", columns={"rh_persona_id"}), @ORM\Index(name="fk_rh_detalle_empleo_ctl_tipo_empleo1_idx", columns={"ctl_tipo_empleo_id"})})
 * @ORM\Entity
 */
class RhDetalleEmpleo
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
     * @ORM\Column(name="estado", type="string", length=45, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio_contrato", type="date", nullable=false)
     */
    private $fechaInicioContrato;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin_contrato", type="date", nullable=false)
     */
    private $fechaFinContrato;

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
     * @var \CtlTipoEmpleo
     *
     * @ORM\ManyToOne(targetEntity="CtlTipoEmpleo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ctl_tipo_empleo_id", referencedColumnName="id")
     * })
     */
    private $ctlTipoEmpleo;



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
     * Set estado
     *
     * @param string $estado
     * @return RhDetalleEmpleo
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
     * Set fechaInicioContrato
     *
     * @param \DateTime $fechaInicioContrato
     * @return RhDetalleEmpleo
     */
    public function setFechaInicioContrato($fechaInicioContrato)
    {
        $this->fechaInicioContrato = $fechaInicioContrato;

        return $this;
    }

    /**
     * Get fechaInicioContrato
     *
     * @return \DateTime 
     */
    public function getFechaInicioContrato()
    {
        return $this->fechaInicioContrato;
    }

    /**
     * Set fechaFinContrato
     *
     * @param \DateTime $fechaFinContrato
     * @return RhDetalleEmpleo
     */
    public function setFechaFinContrato($fechaFinContrato)
    {
        $this->fechaFinContrato = $fechaFinContrato;

        return $this;
    }

    /**
     * Get fechaFinContrato
     *
     * @return \DateTime 
     */
    public function getFechaFinContrato()
    {
        return $this->fechaFinContrato;
    }

    /**
     * Set rhPersona
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersona
     * @return RhDetalleEmpleo
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
     * Set ctlTipoEmpleo
     *
     * @param \ERP\AdminBundle\Entity\CtlTipoEmpleo $ctlTipoEmpleo
     * @return RhDetalleEmpleo
     */
    public function setCtlTipoEmpleo(\ERP\AdminBundle\Entity\CtlTipoEmpleo $ctlTipoEmpleo = null)
    {
        $this->ctlTipoEmpleo = $ctlTipoEmpleo;

        return $this;
    }

    /**
     * Get ctlTipoEmpleo
     *
     * @return \ERP\AdminBundle\Entity\CtlTipoEmpleo 
     */
    public function getCtlTipoEmpleo()
    {
        return $this->ctlTipoEmpleo;
    }
}
