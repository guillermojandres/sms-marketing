<?php

namespace ERP\RrhhBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/RRHH/configuracion", name="rrhh_configuracion")
     */
    public function indexAction()
    {
        return $this->render('ERPRrhhBundle:Default:configuracion.html.twig');
    }
    
     /**
     * @Route("/admin/RRHH/",name="rrhh_dashbord")
     */
    public function DashboardAction()
    {
        return $this->render('ERPRrhhBundle:Default:dashboard.html.twig');
    }
    
     /**
     * @Route("/admin/RRHH/reportes",name="rrhh_reportes")
     */
    public function ReportesAction()
    {
        return $this->render('ERPRrhhBundle:Default:reportes.html.twig');
    }
}
