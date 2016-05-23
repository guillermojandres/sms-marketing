<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlEmpresa
 *
 * @ORM\Table(name="ctl_empresa")
 * @ORM\Entity
 */
class CtlEmpresa
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
     * @ORM\Column(name="nombre_empresa", type="string", length=45, nullable=true)
     */
    private $nombreEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(name="nrc", type="string", length=45, nullable=false)
     */
    private $nrc;

    /**
     * @var string
     *
     * @ORM\Column(name="nit", type="string", length=45, nullable=false)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="giro", type="string", length=45, nullable=false)
     */
    private $giro;



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
     * Set nombreEmpresa
     *
     * @param string $nombreEmpresa
     * @return CtlEmpresa
     */
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }

    /**
     * Get nombreEmpresa
     *
     * @return string 
     */
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }

    /**
     * Set nrc
     *
     * @param string $nrc
     * @return CtlEmpresa
     */
    public function setNrc($nrc)
    {
        $this->nrc = $nrc;

        return $this;
    }

    /**
     * Get nrc
     *
     * @return string 
     */
    public function getNrc()
    {
        return $this->nrc;
    }

    /**
     * Set nit
     *
     * @param string $nit
     * @return CtlEmpresa
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return string 
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set giro
     *
     * @param string $giro
     * @return CtlEmpresa
     */
    public function setGiro($giro)
    {
        $this->giro = $giro;

        return $this;
    }

    /**
     * Get giro
     *
     * @return string 
     */
    public function getGiro()
    {
        return $this->giro;
    }
      public function __toString() {
   return $this->nombreEmpresa;
}
}
