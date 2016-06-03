<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use ERP\AdminBundle\Entity\BeardProducto;
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
        
        return $this->render('ERPCRMBundle:inventariobeard:dashboard.html.twig');       
    }  
    
    /**
     *
     *
     * @Route("/prodexis/data", name="prod_existencia_data")
     */
    public function RegistroExistenciaAction(Request $request) {

        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */

        $entity = new BeardProducto();

        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');

        $em = $this->getDoctrine()->getEntityManager();
        $existenciaTotal = $em->getRepository('ERPAdminBundle:BeardProducto')->findAll();
        $territorio['draw'] = $draw++;
        $territorio['recordsTotal'] = count($existenciaTotal);
        $territorio['recordsFiltered'] = count($existenciaTotal);

        $territorio['data'] = array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ', $busqueda['value']);


        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);

        if ($busqueda['value'] != '') {

            $dql = "SELECT prod.id,prod.nombre as nombre, prod.precio as precio, prod.numeroReferencia as numref , prod.estado as estado, prod.descripcion as descripcion, "
                    . "prod.presentacion as presen, prod.stock as stock, "
                    . "concat(concat('<input type=\"checkbox\" class=\"checkbox idEncabezado\" id=\"',prod.id), '\">' as lin "
                    . "FROM ERPAdminBundle:BeardProducto prod "                                        
                    . "WHERE upper(prod.nombre)  LIKE upper(:busqueda) AND prod.estado = 1 "
                    . "ORDER BY prod.id ASC ";

            //Aqui estas trabjando
            $territorio['data'] = $em->createQuery($dql)
                    ->setParameters(array('busqueda' => "%" . $busqueda['value'] . "%"))
                    ->getResult();

            $territorio['recordsFiltered'] = count($territorio['data']);
           
            $territorio['data'] = $em->createQuery($dql)
                    ->setParameters(array('busqueda' => "%" . $busqueda['value'] . "%"))
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
        } else {
            $dql = "SELECT prod.id as id,prod.nombre as nombre, prod.precio as precio, prod.numeroReferencia as numref , prod.estado as estado, prod.descripcion as descripcion, "
                    . "prod.presentacion as presen, prod.stock as stock, "
                    . "concat(concat('<input type=\"checkbox\" class=\"checkbox idEncabezado\" id=\"',prod.id), '\">' as lin "
                    . "FROM ERPAdminBundle:BeardProducto prod "
                    . "WHERE prod.estado = 1 "
                    . "ORDER BY prod.id ASC ";
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
        }
        return new Response(json_encode($territorio));
    }
    
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/deleteprod", name="delete_prod")
     *
     */  
    public function eliminarProductoAction()
    {   
              
    }  

}
