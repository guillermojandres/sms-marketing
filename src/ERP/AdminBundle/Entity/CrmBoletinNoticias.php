<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmBoletinNoticias
 *
 * @ORM\Table(name="crm_boletin_noticias", indexes={@ORM\Index(name="fk_boletin_noticias_boletin_nombres1_idx", columns={"boletin_nombres_id"})})
 * @ORM\Entity
 */
class CrmBoletinNoticias
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
     * @ORM\Column(name="remitente", type="string", length=100, nullable=true)
     */
    private $remitente;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje", type="text", length=65535, nullable=false)
     */
    private $mensaje;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=250, nullable=true)
     */
    private $asunto;

    /**
     * @var \CtlBoletinNombres
     *
     * @ORM\ManyToOne(targetEntity="CtlBoletinNombres")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="boletin_nombres_id", referencedColumnName="id")
     * })
     */
    private $boletinNombres;



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
     * Set remitente
     *
     * @param string $remitente
     * @return CrmBoletinNoticias
     */
    public function setRemitente($remitente)
    {
        $this->remitente = $remitente;

        return $this;
    }

    /**
     * Get remitente
     *
     * @return string 
     */
    public function getRemitente()
    {
        return $this->remitente;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return CrmBoletinNoticias
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     * @return CrmBoletinNoticias
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string 
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set boletinNombres
     *
     * @param \ERP\AdminBundle\Entity\CtlBoletinNombres $boletinNombres
     * @return CrmBoletinNoticias
     */
    public function setBoletinNombres(\ERP\AdminBundle\Entity\CtlBoletinNombres $boletinNombres = null)
    {
        $this->boletinNombres = $boletinNombres;

        return $this;
    }

    /**
     * Get boletinNombres
     *
     * @return \ERP\AdminBundle\Entity\CtlBoletinNombres 
     */
    public function getBoletinNombres()
    {
        return $this->boletinNombres;
    }
}
