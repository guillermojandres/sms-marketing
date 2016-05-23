<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\CrmEmpresaCliente;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CrmEmpresaClienteRepository extends EntityRepository
{
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('CrmEmpresaClienteEs')
                        ->from('ERPAdminBundle:CrmEmpresaCliente', 'CrmEmpresaClienteEs')
                        ->where('CrmEmpresaClienteEs.estado = true')
                        ;
    }

}
