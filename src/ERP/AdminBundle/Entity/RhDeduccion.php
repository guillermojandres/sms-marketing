<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhDeduccion
 *
 * @ORM\Table(name="rh_deduccion", indexes={@ORM\Index(name="fk_rh_deduccion_rh_tipo_deduccion1_idx", columns={"rh_tipo_deduccion_id"}), @ORM\Index(name="fk_rh_deduccion_rh_estructura_salarios1_idx", columns={"rh_estructura_salarios_id"})})
 * @ORM\Entity
 */
class RhDeduccion
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
     * @var float
     *
     * @ORM\Column(name="importe_deduccion", type="float", precision=10, scale=0, nullable=false)
     */
    private $importeDeduccion;

    /**
     * @var \RhEstructuraSalarios
     *
     * @ORM\ManyToOne(targetEntity="RhEstructuraSalarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_estructura_salarios_id", referencedColumnName="id")
     * })
     */
    private $rhEstructuraSalarios;

    /**
     * @var \RhTipoDeduccion
     *
     * @ORM\ManyToOne(targetEntity="RhTipoDeduccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_tipo_deduccion_id", referencedColumnName="id")
     * })
     */
    private $rhTipoDeduccion;



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
     * Set importeDeduccion
     *
     * @param float $importeDeduccion
     * @return RhDeduccion
     */
    public function setImporteDeduccion($importeDeduccion)
    {
        $this->importeDeduccion = $importeDeduccion;

        return $this;
    }

    /**
     * Get importeDeduccion
     *
     * @return float 
     */
    public function getImporteDeduccion()
    {
        return $this->importeDeduccion;
    }

    /**
     * Set rhEstructuraSalarios
     *
     * @param \ERP\AdminBundle\Entity\RhEstructuraSalarios $rhEstructuraSalarios
     * @return RhDeduccion
     */
    public function setRhEstructuraSalarios(\ERP\AdminBundle\Entity\RhEstructuraSalarios $rhEstructuraSalarios = null)
    {
        $this->rhEstructuraSalarios = $rhEstructuraSalarios;

        return $this;
    }

    /**
     * Get rhEstructuraSalarios
     *
     * @return \ERP\AdminBundle\Entity\RhEstructuraSalarios 
     */
    public function getRhEstructuraSalarios()
    {
        return $this->rhEstructuraSalarios;
    }

    /**
     * Set rhTipoDeduccion
     *
     * @param \ERP\AdminBundle\Entity\RhTipoDeduccion $rhTipoDeduccion
     * @return RhDeduccion
     */
    public function setRhTipoDeduccion(\ERP\AdminBundle\Entity\RhTipoDeduccion $rhTipoDeduccion = null)
    {
        $this->rhTipoDeduccion = $rhTipoDeduccion;

        return $this;
    }

    /**
     * Get rhTipoDeduccion
     *
     * @return \ERP\AdminBundle\Entity\RhTipoDeduccion 
     */
    public function getRhTipoDeduccion()
    {
        return $this->rhTipoDeduccion;
    }
}
