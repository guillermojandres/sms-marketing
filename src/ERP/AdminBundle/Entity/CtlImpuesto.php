<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlImpuesto
 *
 * @ORM\Table(name="ctl_impuesto")
 * @ORM\Entity
 */
class CtlImpuesto
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
     * @ORM\Column(name="imp_nombre", type="string", length=200, nullable=false)
     */
    private $impNombre;

    /**
     * @var float
     *
     * @ORM\Column(name="imp_porcentaje", type="float", precision=10, scale=0, nullable=false)
     */
    private $impPorcentaje;

    /**
     * @var integer
     *
     * @ORM\Column(name="imp_estado", type="integer", nullable=false)
     */
    private $impEstado;



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
     * Set impNombre
     *
     * @param string $impNombre
     * @return CtlImpuesto
     */
    public function setImpNombre($impNombre)
    {
        $this->impNombre = $impNombre;

        return $this;
    }

    /**
     * Get impNombre
     *
     * @return string 
     */
    public function getImpNombre()
    {
        return $this->impNombre;
    }

    /**
     * Set impPorcentaje
     *
     * @param float $impPorcentaje
     * @return CtlImpuesto
     */
    public function setImpPorcentaje($impPorcentaje)
    {
        $this->impPorcentaje = $impPorcentaje;

        return $this;
    }

    /**
     * Get impPorcentaje
     *
     * @return float 
     */
    public function getImpPorcentaje()
    {
        return $this->impPorcentaje;
    }

    /**
     * Set impEstado
     *
     * @param integer $impEstado
     * @return CtlImpuesto
     */
    public function setImpEstado($impEstado)
    {
        $this->impEstado = $impEstado;

        return $this;
    }

    /**
     * Get impEstado
     *
     * @return integer 
     */
    public function getImpEstado()
    {
        return $this->impEstado;
    }
}
