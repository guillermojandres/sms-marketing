<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\CtlIndustriaCliente;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CtlIndustriaClienteRepository extends EntityRepository
{
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('CtlInC')
                        ->from('ERPAdminBundle:CtlIndustriaCliente', 'CtlInC')
                        ->where('CtlInC.estado = true')
                        ;
    }

}
