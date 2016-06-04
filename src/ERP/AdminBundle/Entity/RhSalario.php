<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RhSalario
 *
 * @ORM\Table(name="rh_salario", indexes={@ORM\Index(name="fk_rh_salario_rh_tipo_ingreso1_idx", columns={"rh_tipo_ingreso_id"}), @ORM\Index(name="fk_rh_salario_rh_estructura_salarios1_idx", columns={"rh_estructura_salarios_id"})})
 * @ORM\Entity
 */
class RhSalario
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
     * @ORM\Column(name="importe", type="float", precision=10, scale=0, nullable=false)
     */
    private $importe;

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
     * @var \RhTipoIngreso
     *
     * @ORM\ManyToOne(targetEntity="RhTipoIngreso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rh_tipo_ingreso_id", referencedColumnName="id")
     * })
     */
    private $rhTipoIngreso;



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
     * Set importe
     *
     * @param float $importe
     * @return RhSalario
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return float 
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set rhEstructuraSalarios
     *
     * @param \ERP\AdminBundle\Entity\RhEstructuraSalarios $rhEstructuraSalarios
     * @return RhSalario
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
     * Set rhTipoIngreso
     *
     * @param \ERP\AdminBundle\Entity\RhTipoIngreso $rhTipoIngreso
     * @return RhSalario
     */
    public function setRhTipoIngreso(\ERP\AdminBundle\Entity\RhTipoIngreso $rhTipoIngreso = null)
    {
        $this->rhTipoIngreso = $rhTipoIngreso;

        return $this;
    }

    /**
     * Get rhTipoIngreso
     *
     * @return \ERP\AdminBundle\Entity\RhTipoIngreso 
     */
    public function getRhTipoIngreso()
    {
        return $this->rhTipoIngreso;
    }
}
