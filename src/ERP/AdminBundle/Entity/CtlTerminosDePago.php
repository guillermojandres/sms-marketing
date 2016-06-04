<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlTerminosDePago
 *
 * @ORM\Table(name="ctl_terminos_de_pago")
 * @ORM\Entity
 */
class CtlTerminosDePago
{
    /**
     * @var string
     *
     * @ORM\Column(name="ter_nombre", type="string", length=255, nullable=false)
     */
    private $terNombre;

    /**
     * @var \FactFactura
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="FactFactura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="fact_idterminopago")
     * })
     */
    private $id;



    /**
     * Set terNombre
     *
     * @param string $terNombre
     * @return CtlTerminosDePago
     */
    public function setTerNombre($terNombre)
    {
        $this->terNombre = $terNombre;

        return $this;
    }

    /**
     * Get terNombre
     *
     * @return string 
     */
    public function getTerNombre()
    {
        return $this->terNombre;
    }

    /**
     * Set id
     *
     * @param \ERP\AdminBundle\Entity\FactFactura $id
     * @return CtlTerminosDePago
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
