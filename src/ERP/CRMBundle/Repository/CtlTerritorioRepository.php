<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\CtlTerritorio;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CtlTerritorioRepository extends EntityRepository
{
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('CtlTerritorioA')
                        ->from('ERPAdminBundle:CtlTerritorio', 'CtlTerritorioA')
                        ->where('CtlTerritorioA.estado = true')
                        ;
    }

}
