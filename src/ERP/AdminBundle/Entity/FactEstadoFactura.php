<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactEstadoFactura
 *
 * @ORM\Table(name="fact_estado_factura")
 * @ORM\Entity
 */
class FactEstadoFactura
{
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var \FactFactura
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="FactFactura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="fat_id_estado_factura")
     * })
     */
    private $id;



    /**
     * Set estado
     *
     * @param string $estado
     * @return FactEstadoFactura
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
     * Set id
     *
     * @param \ERP\AdminBundle\Entity\FactFactura $id
     * @return FactEstadoFactura
     */
    public function setId(\ERP\AdminBundle\Entity\FactFactura $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \ERP\AdminBundle\Entity\FactFactura 
     */
    public function getId()
    {
        return $this->id;
    }
}
