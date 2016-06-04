<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\CtlCatigoriaCliente;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CtlCategoriaClienteRepository extends EntityRepository
{
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('CtlCategoriaClienteA')
                        ->from('ERPAdminBundle:CtlCategoriaCliente', 'CtlCategoriaClienteA')
                        ->where('CtlCategoriaClienteA.estado = true')
                        ;
    }

}
