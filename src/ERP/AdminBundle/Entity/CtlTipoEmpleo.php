<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlTipoEmpleo
 *
 * @ORM\Table(name="ctl_tipo_empleo")
 * @ORM\Entity
 */
class CtlTipoEmpleo
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
     * @ORM\Column(name="nombre_tipo_empleocol", type="string", length=45, nullable=false)
     */
    private $nombreTipoEmpleocol;



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
     * Set nombreTipoEmpleocol
     *
     * @param string $nombreTipoEmpleocol
     * @return CtlTipoEmpleo
     */
    public function setNombreTipoEmpleocol($nombreTipoEmpleocol)
    {
        $this->nombreTipoEmpleocol = $nombreTipoEmpleocol;

        return $this;
    }

    /**
     * Get nombreTipoEmpleocol
     *
     * @return string 
     */
    public function getNombreTipoEmpleocol()
    {
        return $this->nombreTipoEmpleocol;
    }
}
