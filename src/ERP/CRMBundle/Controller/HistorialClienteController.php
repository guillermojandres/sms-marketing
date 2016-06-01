<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\Cliente;
use ERP\AdminBundle\Form\ClienteType;
use Symfony\Component\HttpKernel\Exception;
use Doctrine\ORM\Query\ResultSetMapping;
/**
 * Cliente controller.
 *
 * @Route("admin/historialcliente")
 */
class HistorialClienteController extends Controller
{
    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/", name="admin_cliente_index",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('ERPAdminBundle:Cliente')->findAll();
        
        return $this->render('ERPCRMBundle:clientes/index.html.twig', array(
            'cliente' => $cliente,
        ));
    }
    
    
    
    
     
     
      /**
     *
     *
     * @Route("/facturacion/data", name="admin_facturacion_data", options={"expose"=true})
     */
    public function dataFacturacionAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
       
        $cliente = $request->query->get('param1');
        $fechaini = $request->query->get('param2');
        $fechafin = $request->query->get('param3');
       
//        var_dump($abogado);
//        var_dump($fechaini);
//        var_dump($fechafin);
//        
//        die();
       
        $facturacionTotal = $em->getRepository('ERPAdminBundle:Cliente')->findAll();
        $facturacion['draw']=$draw++; 
        $facturacion['data']= array();
       
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        $rsm = new ResultSetMapping();

        $sql = "SELECT enc.id as encabezado, "
                . "concat_ws(cli.codigo, '<div class=\"text-right\">', '</div>') as codigo, "
                . "concat_ws(DATE_FORMAT(enc.fecha_registro,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro, "
                . "concat_ws(enc.estado, '<div class=\"text-center\">', '</div>') as estado, "
                . "concat_ws(enc.tipo_venta, '<div class=\"text-center\">', '</div>') as tipoVenta, "
                . "concat_ws(enc.tipo_pago, '<div class=\"text-center\">', '</div>') as tipo_pago, "
                . "concat_ws(enc.monto, '<div class=\"text-center\">', '</div>') as monto, "
                . "concat_ws(enc.id, '<a class=\"link_facturacion\" id=\"', '\">Ver detalles</a>') as link "
                . "FROM encabezado_orden enc  inner join cliente cli on enc.crm_cliente_id = cli.id "
                . "WHERE 1 = 1 ";

        if($cliente != 'null'){
            $sql.="and enc.crm_cliente_id = '$cliente' ";
        }
       
     
        if($fechaini != "" && $fechafin != ""){
//            $inicio = explode("-", $fechaini);
//            $fin = explode("-", $fechafin);
//            $fi = $inicio[2]."-".$inicio[1]."-".$inicio[0];
//            $ff = $fin[2]."-".$fin[1]."-".$fin[0];
           
            $sql.="and enc.fecha_registro >= '$fechaini' and enc.fecha_registro <= '$fechafin' ";
        }

        $sql.= "ORDER BY enc.fecha_registro DESC "
                . "LIMIT $start, $longitud ";
        //echo $sql;
        $rsm->addScalarResult('codigo','codigo');
        $rsm->addScalarResult('fecha_registro','fecha_registro');
        $rsm->addScalarResult('estado','estado');
        $rsm->addScalarResult('tipoVenta','tipoVenta');
        $rsm->addScalarResult('monto','monto');
        $rsm->addScalarResult('tipo_pago','tipo_pago');
        $rsm->addScalarResult('link','link');

        $facturacion['data'] = $em->createNativeQuery($sql, $rsm)
                                  ->getResult();
       
        $rsm2 = new ResultSetMapping();

          $sql2 = "SELECT enc.id as encabezado, "
                . "concat_ws(cli.codigo, '<div class=\"text-right\">', '</div>') as codigo, "
                . "concat_ws(DATE_FORMAT(enc.fecha_registro,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro, "
                . "concat_ws(enc.estado, '<div class=\"text-center\">', '</div>') as estado, "
                . "concat_ws(enc.tipo_venta, '<div class=\"text-center\">', '</div>') as tipoVenta, "
                . "concat_ws(enc.tipo_pago, '<div class=\"text-center\">', '</div>') as tipo_pago, "
                . "concat_ws(enc.monto, '<div class=\"text-center\">', '</div>') as monto, "
                . "concat_ws(enc.id, '<a class=\"link_facturacion\" id=\"', '\">Ver detalles</a>') as link "
                . "FROM encabezado_orden enc  inner join cliente cli on enc.crm_cliente_id = cli.id "
                . "WHERE 1 = 1 ";

        if($cliente != 'null'){
            $sql2.="and enc.crm_cliente_id = '$cliente' ";
        }
       
      
       
        if($fechaini != "" && $fechafin != ""){
//            $inicio = explode("-", $fechaini);
//            $fin = explode("-", $fechafin);
//            $fi = $inicio[2]."-".$inicio[1]."-".$inicio[0];
//            $ff = $fin[2]."-".$fin[1]."-".$fin[0];
//           
           $sql2.="and enc.fecha_registro >= '$fechaini' and enc.fecha_registro <= '$fechafin' ";
        }

       $rsm2->addScalarResult('codigo','codigo');
        $rsm2->addScalarResult('fecha_registro','fecha_registro');
        $rsm2->addScalarResult('estado','estado');
        $rsm2->addScalarResult('tipoVenta','tipoVenta');
        $rsm2->addScalarResult('monto','monto');
        $rsm2->addScalarResult('tipo_pago','tipo_pago');
        $rsm2->addScalarResult('link','link');

        $facturaciototal = $em->createNativeQuery($sql2, $rsm2)
                                  ->getResult();
       
        $facturacion['recordsTotal'] = count($facturaciototal);
        $facturacion['recordsFiltered']= count($facturaciototal);
       
        return new Response(json_encode($facturacion));
    }
     
     
     
     /**
    * Ajax utilizado para buscar informacion de abogados
    * 
    * @Route("/historial/busqueda-abogado-select/data", name="busqueda_abogado_select", options={"expose"=true})
    */
    public function busquedaAbogadoAction(Request $request)
    {
        $busqueda = $request->query->get('q');
        $page = $request->query->get('page');
       
        $em = $this->getDoctrine()->getManager();
       
        $rsm = new ResultSetMapping();
        $sql = "select cli.id abogadoid, cli.nombre as nombres, cli.codigo from cliente cli
                    where (upper(cli.codigo)  LIKE upper('%".$busqueda."%') OR upper(cli.nombre)  LIKE upper('%".$busqueda."%') ) AND cli.categoria = 'Distribuidor'
                    order by cli.codigo asc
                    limit 0, 10";
               
        $rsm->addScalarResult('abogadoid','abogadoid');
        $rsm->addScalarResult('nombres','nombres');
        $rsm->addScalarResult('codigo','codigo');

        $abogado['data'] = $em->createNativeQuery($sql, $rsm)
                                  ->getResult();
       
        return new Response(json_encode($abogado));
    }
     
     
     
     
     
     
     
     
    
    
    
    
}
