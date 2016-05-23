<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmDetalleReferenciaCliente
 *
 * @ORM\Table(name="crm_detalle_referencia_cliente", indexes={@ORM\Index(name="fk_detalle_referencia_cliente_contacto1_idx", columns={"contacto_id"})})
 * @ORM\Entity
 */
class CrmDetalleReferenciaCliente
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
     * @var integer
     *
     * @ORM\Column(name="id_referencia", type="integer", nullable=true)
     */
    private $idReferencia;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_referencia", type="string", length=45, nullable=true)
     */
    private $nombreReferencia;

    /**
     * @var \CrmContacto
     *
     * @ORM\ManyToOne(targetEntity="CrmContacto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contacto_id", referencedColumnName="id")
     * })
     */
    private $contacto;



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
     * Set idReferencia
     *
     * @param integer $idReferencia
     * @return CrmDetalleReferenciaCliente
     */
    public function setIdReferencia($idReferencia)
    {
        $this->idReferencia = $idReferencia;

        return $this;
    }

    /**
     * Get idReferencia
     *
     * @return integer 
     */
    public function getIdReferencia()
    {
        return $this->idReferencia;
    }

    /**
     * Set nombreReferencia
     *
     * @param string $nombreReferencia
     * @return CrmDetalleReferenciaCliente
     */
    public function setNombreReferencia($nombreReferencia)
    {
        $this->nombreReferencia = $nombreReferencia;

        return $this;
    }

    /**
     * Get nombreReferencia
     *
     * @return string 
     */
    public function getNombreReferencia()
    {
        return $this->nombreReferencia;
    }

    /**
     * Set contacto
     *
     * @param \ERP\AdminBundle\Entity\CrmContacto $contacto
     * @return CrmDetalleReferenciaCliente
     */
    public function setContacto(\ERP\AdminBundle\Entity\CrmContacto $contacto = null)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return \ERP\AdminBundle\Entity\CrmContacto 
     */
    public function getContacto()
    {
        return $this->contacto;
    }
}
