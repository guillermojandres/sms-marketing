<?php //

namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmCliente;
use ERP\AdminBundle\Entity\Orden;
use ERP\AdminBundle\Entity\EncabezadoOrden;
use ERP\AdminBundle\Form\CrmClienteType;
use Symfony\Component\HttpKernel\Exception;


/**
 * ClientePotencial controller.
 *
 * @Route("admin/dashboard")
 */
class DashBoardController extends Controller
{
    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/", name="dashboard_index",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        
        return $this->render('ERPCRMBundle:dashboard/index.html.twig', array(
            
        ));
    }
    
     /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/ordenesdecompra", name="ordenesdecompra",options={"expose"=true})
     * @Method("GET")
     */
    public function OrdenesDeCompraAction()
    {
        
        return $this->render('ERPCRMBundle:ordenesdecompra/index2.html.twig', array(
            
        ));
    }
    
     /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/crm", name="dashboard_indexCRM",options={"expose"=true})
     * @Method("GET")
     */
    public function CRMAction()
    {
        
        return $this->render('ERPCRMBundle:dashboard/dashboardcrm.html.twig', array(
            
        ));
    }
    
     /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/historialcliente", name="dashboardhistorialcliente",options={"expose"=true})
     * @Method("GET")
     */
    public function HistorialClienteAction()
    {
        
        return $this->render('ERPCRMBundle:dashboard/dashboardhistorialcliente.html.twig', array(
            
        ));
    }
    
    
    
 }
