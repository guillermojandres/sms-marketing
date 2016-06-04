<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/CRM/configuracion",name="crm_configuracion")
     */
    public function indexAction()
    {
        return $this->render('ERPCRMBundle:general:configuracion.html.twig');
    }
    
     /**
     * @Route("/admin/CRM",name="crm_dashbord", options={"expose"=true})
     */
    public function DashboardAction()
    {
        return $this->render('ERPCRMBundle:general:dashboard.html.twig');
    }
    
     /**
     * @Route("/admin/CRM/reportes",name="crm_reportes")
     */
    public function ReportesAction()
    {
        return $this->render('ERPCRMBundle:general:reportes.html.twig');
    }
    
    
    
    
}
