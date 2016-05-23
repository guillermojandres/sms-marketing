<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * InvProveedor controller.
 *
 * @Route("/admin/inventariobearddelete")
 */
class InventariobeardDeleteController extends Controller
{
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/delprod", name="inventariobeard_delprod")
     *
     */  
    public function EliminarClienteAction()
    {        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        
            $idcliente = $this->get('request')->request->get('idproducto');
            
     
            foreach($idcliente as $row){
                $em = $this->getDoctrine()->getManager();
                $cliente = $em->getRepository('ERPAdminBundle:BeardProducto')->find($row);    
                $cliente->setEstado(0);
                $em->persist($cliente);
                $em->flush();                
            }
   
//            $response->setData(array(
//                'flag' => 0,                       
//            ));    
            //return $response;                               
            return new Response(json_encode(0));
    }                      
}
