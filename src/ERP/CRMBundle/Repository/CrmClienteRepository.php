<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\CrmCliente;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CrmClienteRepository extends EntityRepository
{
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('clienteEs')
                        ->from('ERPAdminBundle:CrmCliente', 'clienteEs')
                        ->where('clienteEs.estado = true')
                        ;
    }

}
