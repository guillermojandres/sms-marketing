<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * InvProveedor controller.
 *
 * @Route("/admin/inventariobeard")
 */
class InventariobeardController extends Controller
{
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/listprod", name="inventariobeard_listprod")
     *
     */  
    public function indexAction()
    {   
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository('ERPAdminBundle:BeardProducto')->findBy(array('estado'=>1));
        
        return $this->render('ERPCRMBundle:inventariobeard:dashboard.html.twig',array('productos'=>$productos));       
    }                    
}
