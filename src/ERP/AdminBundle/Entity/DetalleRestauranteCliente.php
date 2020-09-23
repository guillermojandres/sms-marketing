<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetalleRestauranteCliente
 *
 * @ORM\Table(name="detalle_restaurante_cliente", indexes={@ORM\Index(name="fk_detalle_restaurante_cliente_cliente1", columns={"cliente_id"}), @ORM\Index(name="fk_detalle_restaurante_cliente_restaurante1", columns={"restaurante_id"})})
 * @ORM\Entity
 */
class DetalleRestauranteCliente
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
     * @var \Restaurante
     *
     * @ORM\ManyToOne(targetEntity="Restaurante")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="restaurante_id", referencedColumnName="id")
     * })
     */
    private $restaurante;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @var integer
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var date
     * @ORM\Column(name="fecha_creacion", type="date", nullable=false)
     */
    private $fechaCreacion;
    /**
     * @var date
     * @ORM\Column(name="fecha_modificacion", type="date", nullable=false)
     */
    private $fechaModificacion;

    /**
     * @var date
     * @ORM\Column(name="fecha_de_baja", type="date", nullable=false)
     */
    private $fechaBaja;


    /**
     * Set producto
     *
     * @param \ERP\AdminBundle\Entity\Restaurante $restaurante
     * @return DetalleRestauranteCliente
     */
    public function setRestaurante(\ERP\AdminBundle\Entity\Restaurante $restaurante = null)
    {
        $this->restaurante = $restaurante;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \ERP\AdminBundle\Entity\Restaurante
     */
    public function getRestaurante()
    {
        return $this->restaurante;
    }


    /**
     * Set factura
     *
     * @param \ERP\AdminBundle\Entity\Cliente $cliente
     * @return Cliente
     */
    public function setCliente(\ERP\AdminBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get factura
     *
     * @return \DG\AdminBundle\Entity\Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set estado
     *
     * @param string $estado
     * @return Restaurante
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }


    /**
     * Set fecha_insercion
     *
     * @param string $fecha_insercion
     * @return Restaurante
     */
    public function setFechaInsercion($fecha_insercion)
    {
        $this->fechaCreacion = $fecha_insercion;

        return $this;
    }

    /**
     * Get fecha_insercion
     *
     * @return integer
     */
    public function getFechaInsercion()
    {
        return $this->fechaInsercion;
    }


    /**
     * Set fecha_modificacion
     *
     * @param string $fecha_modificacion
     * @return Restaurante
     */
    public function setFechaModificacion($fecha_modificacion)
    {
        $this->fechaModificacion = $fecha_modificacion;

        return $this;
    }

    /**
     * Get fecha_modificacion
     *
     * @return integer
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }


    /**
     * Set fecha_insercion
     *
     * @param string $fecha_insercion
     * @return Restaurante
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    /**
     * Get fecha_insercion
     *
     * @return integer
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }






}
