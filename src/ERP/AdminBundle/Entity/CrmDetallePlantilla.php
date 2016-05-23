<?php

namespace ERP\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CrmDetallePlantilla
 *
 * @ORM\Table(name="crm_detalle_plantilla", indexes={@ORM\Index(name="fk_detalle_plantilla_plantilla1_idx", columns={"plantilla_id"})})
 * @ORM\Entity
 */
class CrmDetallePlantilla
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
     * @ORM\Column(name="nombre_campo_plantilla", type="string", length=255, nullable=true)
     */
    private $nombreCampoPlantilla;

    /**
     * @var \CrmPlantilla
     *
     * @ORM\ManyToOne(targetEntity="CrmPlantilla")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="plantilla_id", referencedColumnName="id")
     * })
     */
    private $plantilla;



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
     * Set nombreCampoPlantilla
     *
     * @param string $nombreCampoPlantilla
     * @return CrmDetallePlantilla
     */
    public function setNombreCampoPlantilla($nombreCampoPlantilla)
    {
        $this->nombreCampoPlantilla = $nombreCampoPlantilla;

        return $this;
    }

    /**
     * Get nombreCampoPlantilla
     *
     * @return string 
     */
    public function getNombreCampoPlantilla()
    {
        return $this->nombreCampoPlantilla;
    }

    /**
     * Set plantilla
     *
     * @param \ERP\AdminBundle\Entity\CrmPlantilla $plantilla
     * @return CrmDetallePlantilla
     */
    public function setPlantilla(\ERP\AdminBundle\Entity\CrmPlantilla $plantilla = null)
    {
        $this->plantilla = $plantilla;

        return $this;
    }

    /**
     * Get plantilla
     *
     * @return \ERP\AdminBundle\Entity\CrmPlantilla 
     */
    public function getPlantilla()
    {
        return $this->plantilla;
    }
}
