<?php

namespace ERP\CRMBundle\Repository;

use ERPAdminBundle\Entity\CtlReferenciaCliente;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

class CtlReferenciaClienteRepository extends EntityRepository
{   
    public function obtenerNombreActivo()
    {
        return $this->getEntityManager()
                        ->createQueryBuilder()
                        ->select('CtlRC')
                        ->from('ERPAdminBundle:CtlReferenciaCliente', 'CtlRC')
                        ->where('CtlRC.estado = true')
                        ;
    }

}
