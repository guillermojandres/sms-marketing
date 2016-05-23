<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\CtlEstadoClientePotencial;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CtlEstadoClientePotencialRepository extends EntityRepository
{
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('estaCP')
                        ->from('ERPAdminBundle:CtlEstadoClientePotencial', 'estaCP')
                        ->where('estaCP.estado = true')
                        ;
    }

}
