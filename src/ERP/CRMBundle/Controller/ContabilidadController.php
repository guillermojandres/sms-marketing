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
 * @Route("admin/contabilidad")
 */
class ContabilidadController extends Controller
{
    /**
     * Lists all Contabilidad entities.
     *
     * @Route("/", name="admin_contabilidad_index",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
//        $em = $this->getDoctrine()->getManager();
//        $cliente = $em->getRepository('ERPAdminBundle:Cliente')->findAll();
        
        return $this->render('ERPCRMBundle:contabilidad/indexContabilidad.html.twig', array(
     
        ));
    }

    
     
          /**
     *
     * @Route("/abonos", name="admin_abonos_index",options={"expose"=true})
     * @Method("GET")
     */
    public function AbonosAction(Request $request)
    {


        return $this->render('ERPCRMBundle:contabilidad/indexAbonos.html.twig', array(

        ));
    }
 
    /**
     *
     *
     * @Route("/abonos/data", name="admin_abonos_data", options={"expose"=true})
     */
    public function DataAbonosAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
       
        $cliente = $request->query->get('param1');
        $fechaini = $request->query->get('param2');
        $fechafin = $request->query->get('param3');
       
//        var_dump($cliente);
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
                . "concat_ws(DATE_FORMAT(enc.fecha_registro_cliente,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro_cliente, "
                . "concat_ws(DATE_FORMAT(enc.fecha_registro_sistema,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro_sistema, "
                . "concat_ws(enc.monto_abono, '<div class=\"text-center\">', '</div>') as monto_abono, "
                . "concat_ws(enc.id, '<i class=\" colorAnclas fa fa-file-pdf-o verPDFAbono\" id=\"', '\" title=\"Ver PDF\"></i>&nbsp;&nbsp;<i class=\" colorAnclas fa fa-file-excel-o verExcelAbono\" id=\"', '\" title=\"Descargar excel\"></i>'  ) as link "
                . "FROM abono enc  inner join cliente cli on enc.id_cliente = cli.id "
                . "WHERE 1 = 1 ";

        if($cliente != 'null'){
            $sql.="and enc.id_cliente = '$cliente' ";
        }
       
     
        if($fechaini != "" && $fechafin != ""){
//            $inicio = explode("-", $fechaini);
//            $fin = explode("-", $fechafin);
//            $fi = $inicio[2]."-".$inicio[1]."-".$inicio[0];
//            $ff = $fin[2]."-".$fin[1]."-".$fin[0];
           
            $sql.="and enc.fecha_registro_cliente >= '$fechaini' and enc.fecha_registro_cliente <= '$fechafin' ";
        }

        $sql.= "ORDER BY enc.fecha_registro_cliente DESC "
                . "LIMIT $start, $longitud ";
        //echo $sql;
        $rsm->addScalarResult('codigo','codigo');
         $rsm->addScalarResult('fecha_registro_cliente','fecha_registro_cliente');
        $rsm->addScalarResult('fecha_registro_sistema','fecha_registro_sistema');
        $rsm->addScalarResult('monto_abono','monto_abono');
        $rsm->addScalarResult('link','link');

        $facturacion['data'] = $em->createNativeQuery($sql, $rsm)
                                  ->getResult();
       
        $rsm2 = new ResultSetMapping();

          $sql2 ="SELECT enc.id as encabezado, "
                . "concat_ws(cli.codigo, '<div class=\"text-right\">', '</div>') as codigo, "
                . "concat_ws(DATE_FORMAT(enc.fecha_registro_cliente,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro_cliente, "
                . "concat_ws(DATE_FORMAT(enc.fecha_registro_sistema,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro_sistema, "
                . "concat_ws(enc.monto_abono, '<div class=\"text-center\">', '</div>') as monto_abono, "
                . "concat_ws(enc.id, '<i class=\" colorAnclas fa fa-file-pdf-o verPDFAbono\" id=\"', '\" title=\"Ver PDF\"></i>&nbsp;&nbsp;<i class=\" colorAnclas fa fa-file-excel-o verExcelAbono\" id=\"', '\" title=\"Descargar excel\"></i>'  ) as link "
                . "FROM abono enc  inner join cliente cli on enc.id_cliente = cli.id "
                . "WHERE 1 = 1 ";

        if($cliente != 'null'){
            $sql2.="and enc.id_cliente = '$cliente' ";
        }
       
      
       
        if($fechaini != "" && $fechafin != ""){
//            $inicio = explode("-", $fechaini);
//            $fin = explode("-", $fechafin);
//            $fi = $inicio[2]."-".$inicio[1]."-".$inicio[0];
//            $ff = $fin[2]."-".$fin[1]."-".$fin[0];
//           
           $sql2.="and enc.fecha_registro_cliente >= '$fechaini' and enc.fecha_registro_cliente <= '$fechafin' ";
        }

        $rsm2->addScalarResult('codigo', 'codigo');
        $rsm2->addScalarResult('fecha_registro_cliente', 'fecha_registro_cliente');
        $rsm2->addScalarResult('fecha_registro_sistema', 'fecha_registro_sistema');
        $rsm2->addScalarResult('monto_abono', 'monto_abono');
        $rsm2->addScalarResult('link', 'link');

        $facturaciototal = $em->createNativeQuery($sql2, $rsm2)
                                  ->getResult();
       
        $facturacion['recordsTotal'] = count($facturaciototal);
        $facturacion['recordsFiltered']= count($facturaciototal);
       
        return new Response(json_encode($facturacion));
    }
     
        /**
     * @Route("/llamarTotalDeudaCliente/", name="llamarTotalDeudaCliente", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function InsertarClienteAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
 
         if($isAjax){
              $em = $this->getDoctrine()->getEntityManager();
             $totales = array();
            
             
//            $em = $this->getDoctrine()->getManager();
            
            $idCliente = $request->get('idCliente'); 
           
                   $sql = "SELECT SUM(monto) as total  from encabezado_orden enc  WHERE enc.crm_cliente_id=".$idCliente
                           . " AND (enc.estado=4 OR enc.estado=3 OR enc.estado=2) ";
                   
                   
                   
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $totales= $stmt->fetchAll();
             
             $total=$totales[0]['total'];
          
             $data['total']=$total;   
            $data['estado']=true;
                       
            
            
            
            
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
     
     
     
     
     
     
    
    
    
    
}
