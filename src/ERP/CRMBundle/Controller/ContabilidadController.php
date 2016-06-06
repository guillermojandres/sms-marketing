<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\Cliente;
use ERP\AdminBundle\Entity\Abono;
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
                 . "concat_ws(enc.id, '<div class=\"text-right\">', '</div>') as id, "
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
        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('codigo', 'codigo');
        $rsm->addScalarResult('fecha_registro_cliente', 'fecha_registro_cliente');
        $rsm->addScalarResult('fecha_registro_sistema', 'fecha_registro_sistema');
        $rsm->addScalarResult('monto_abono', 'monto_abono');
        $rsm->addScalarResult('link', 'link');

        $facturacion['data'] = $em->createNativeQuery($sql, $rsm)
                                  ->getResult();
       
        $rsm2 = new ResultSetMapping();

          $sql2 ="SELECT enc.id as encabezado, "
                . "concat_ws(enc.id, '<div class=\"text-right\">', '</div>') as id, "
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

        $rsm2->addScalarResult('id','id');
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
    
    
      public function LlamarTotalDeudaClienteAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
 
         if($isAjax){
              $em = $this->getDoctrine()->getEntityManager();
             $totales = array();
            
             
//            $em = $this->getDoctrine()->getManager();
            
            $idCliente = $request->get('idCliente'); 
           
                   $sql = "SELECT SUM(monto) as total  from encabezado_orden enc  WHERE enc.crm_cliente_id=".$idCliente
                           . " AND (enc.estado=4 OR enc.estado=3 OR enc.estado=2) ";
                   
                   $sqlAbono = "SELECT SUM(monto_abono) as totalAbono  from abono enc  WHERE enc.id_cliente=".$idCliente;

            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $totales= $stmt->fetchAll();
            
            $stmt2 = $em->getConnection()->prepare($sqlAbono);
            $stmt2->execute();
            $totalesAbono= $stmt2->fetchAll();
            
            
             
            $totalAbonos =$totalesAbono[0]['totalAbono']; 
            $totalDueuda=$totales[0]['total'];
         
            if ($totalAbonos==null)
            {
                $totalAbonos=0;
                
            }
            if ($totalDueuda==null)
            {
                $totalDueuda=0;
                
            }
            
            
            $total=$totalDueuda-$totalAbonos;
            
            $data['total']=$total;   
            $data['estado']=true;
                       
            
            
            
            
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
     
     
     
      /**
     * @Route("/insertarAbono/", name="insertarAbono", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function InsertarAbonoAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
             
            $em = $this->getDoctrine()->getManager();
            $montoAbono = $request->get('montoAbono');
            $idCliente = $request->get('idCliente'); 
             
             $sql = "SELECT SUM(monto) as total  from encabezado_orden enc  WHERE enc.crm_cliente_id=".$idCliente
                           . " AND (enc.estado=4 OR enc.estado=3 OR enc.estado=2) ";
              $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $totales= $stmt->fetchAll();   
            $totalDueuda=$totales[0]['total'];
            if ($montoAbono<=$totalDueuda){
                
            $fechaRegistroCliente = $request->get('fechaRegistroCliente'); 
           
            $montoAbono = $request->get('montoAbono');
            $cliente= $this->getDoctrine()->getRepository('ERPAdminBundle:Cliente')->findById($idCliente);                    

            $objeto = new Abono();
            $objeto->setMontoAbono($montoAbono);
            $objeto->setFechaRegistroCliente(new \DateTime($fechaRegistroCliente));
            $objeto->setFechaRegistroSistema(new \DateTime());
            $objeto->setCliente($cliente[0]);
            $em->persist($objeto);
            $em->flush();
            $data['estado']=true;
                
                
                
                
            }else{
                
                $data['estado']=false;
            }
            
            
            
            
           
                       
            
            
            
            
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
     
     /**
     * @Route("/llamarDatosEdicion/", name="llamarDatosEdicion", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function LlamarDatosEdicionAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
             
            $em = $this->getDoctrine()->getManager();
            $idRegistro = $request->get('idRegistro');
                  
            $numero = str_replace('<div class="text-right">', '', $idRegistro);
            $numero = str_replace('</div>', '', $numero);

            
            
            $detalle= $this->getDoctrine()->getRepository('ERPAdminBundle:Abono')->findById($numero);                    
          
            $n=$detalle[0]->getFechaRegistroCliente();
            $l=(DATE_FORMAT($n,'d-m-Y'));
         
       
            $data['montoAbono']=$detalle[0]->getMontoAbono();
            $data['idCliente']=$detalle[0]->getClienteId();
            $data['nombreCliente']=$detalle[0]->getClienteId()->getNombre();
            $data['fechaRegistro']=$l;
            $data['estado']=true;
        
            
            }
            
             return new Response(json_encode($data)); 

    }
    
    
     /**
     * @Route("/editarAbono/", name="editarAbono", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function EditarAbonoAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
             
            $em = $this->getDoctrine()->getManager();
            $montoAbono = $request->get('montoAbono');
            $idCliente = $request->get('idCliente'); 
             
             $sql = "SELECT SUM(monto) as total  from encabezado_orden enc  WHERE enc.crm_cliente_id=".$idCliente
                           . " AND (enc.estado=4 OR enc.estado=3 OR enc.estado=2) ";
              $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $totales= $stmt->fetchAll();   
            $totalDueuda=$totales[0]['total'];
            if ($montoAbono<=$totalDueuda){
                
            //Aqui te has quedado en lo de la deuda
                
                
    
 
            $idDetalle= $request->get('idDetalle'); 
            $fechaRegistroCliente = $request->get('fechaRegistroCliente'); 
            $montoAbono = $request->get('montoAbono');
            
            
            $cliente= $this->getDoctrine()->getRepository('ERPAdminBundle:Cliente')->findById($idCliente); 
            
            $objeto = $this->getDoctrine()->getRepository('ERPAdminBundle:Abono')->findById($idDetalle);
            $objeto[0]->getMontoAbono();
            $objeto[0]->getFechaRegistroCliente();
            $objeto[0]->getFechaRegistroSistema();
            $objeto[0]->getCliente();
            $em->merge($objeto);
            $em->flush();
            $data['estado']=true;
                
                
                
                
            }else{
                
                $data['estado']=false;
            }
            
            
            
            
           
                       
            
            
            
            
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
     
     
    
    
    
    
}
