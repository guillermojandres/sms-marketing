<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abono
 *
 * @ORM\Table(name="abono", indexes={@ORM\Index(name="fk_abono_cliente1", columns={"id_cliente"})})
 * @ORM\Entity
 */
class Abono
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
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cliente", referencedColumnName="id")
     * })
     */
    private $clienteId;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro_cliente", type="date", nullable=true)
     */
    private $fechaRegistroCliente;
    
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro_sistema", type="date", nullable=true)
     */
    private $fechaRegistroSistema;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="monto_abono", type="decimal", nullable=false)
     */
    private $montoAbono;
    
    
    

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
     * Set clienteId
     *
     * @param \ERP\AdminBundle\Entity\Cliente $clienteId
     * @return Cliente
     */
    public function setCliente(\ERP\AdminBundle\Entity\Cliente  $clienteId = null)
    {
        $this->clienteId = $clienteId;

        return $this;
    }

    /**
     * Get clienteId
     *
     * @return \ERP\AdminBundle\Entity\Cliente $clienteId
     */
    public function getClienteId()
    {
        return $this->clienteId;
    }  
    
     /**
     * Set fechaRegistroCliente
     *
     * @param \DateTime $fechaRegistroCliente
     * @return Abono
     */
    public function setFechaRegistroCliente($fechaRegistroCliente)
    {
        $this->fechaRegistroCliente = $fechaRegistroCliente;

        return $this;
    }

    /**
     * Get fechaRegistroCliente
     *
     * @return \DateTime 
     */
    public function getFechaRegistroCliente()
    {
        return $this->fechaRegistroCliente;
    }
    
     /**
     * Set fechaRegistroSistema
     *
     * @param \DateTime $fechaRegistroSistema
     * @return Abono
     */
    public function setFechaRegistroSistema($fechaRegistroSistema)
    {
        $this->fechaRegistroSistema = $fechaRegistroSistema;

        return $this;
    }

    /**
     * Get fechaRegistroSistema
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistroSistema;
    }
    
    
     /**
     * Set montoAbono
     *
     * @param decimal $montoAbono
     * @return Abono
     */
    public function setMontoAbono($montoAbono)
    {
        $this->montoAbono = $montoAbono;

        return $this;
    }

    /**
     * Get montoAbono
     *
     * @return decimal 
     */
    public function getMontoAbono()
    {
        return $this->montoAbono;
    }
    
    
    
}
