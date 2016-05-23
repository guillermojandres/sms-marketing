<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CtlUsuario
 *
 * @ORM\Table(name="ctl_usuario", indexes={@ORM\Index(name="fk_ctl_usuario_rh_persona1_idx", columns={"rh_persona_id"})})
 * @ORM\Entity
 */
class CtlUsuario
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
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CtlRol", mappedBy="ctlUsuario")
     */
    private $ctlRol;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ctlRol = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * Set username
     *
     * @param string $username
     * @return CtlUsuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return CtlUsuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return CtlUsuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return CtlUsuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set rhPersona
     *
     * @param \ERP\AdminBundle\Entity\RhPersona $rhPersona
     * @return CtlUsuario
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
     * Add ctlRol
     *
     * @param \ERP\AdminBundle\Entity\CtlRol $ctlRol
     * @return CtlUsuario
     */
    public function addCtlRol(\ERP\AdminBundle\Entity\CtlRol $ctlRol)
    {
        $this->ctlRol[] = $ctlRol;

        return $this;
    }

    /**
     * Remove ctlRol
     *
     * @param \ERP\AdminBundle\Entity\CtlRol $ctlRol
     */
    public function removeCtlRol(\ERP\AdminBundle\Entity\CtlRol $ctlRol)
    {
        $this->ctlRol->removeElement($ctlRol);
    }

    /**
     * Get ctlRol
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCtlRol()
    {
        return $this->ctlRol;
    }
    
    public function __toString() {
        
         return $this->username;
    }
    
    
    
    
}
