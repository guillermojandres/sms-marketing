<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\InvProveedor;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class InvProveedorRepository extends EntityRepository
{
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('InvProvee')
                        ->from('ERPAdminBundle:InvProveedor', 'InvProvee')
                        ->where('InvProvee.estado = true')
                        ;
    }

}
