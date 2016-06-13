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
include_once '../src/ERP/CRMBundle/Resources/dompdf/dompdf_config.inc.php'; 
include_once "../src/ERP/CRMBundle/Resources/phpexcel/lib/PHPExcel/IOFactory.php";
include_once "../src/ERP/CRMBundle/Resources/phpexcel/lib/PHPExcel.php";
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
 
        return $this->render('ERPCRMBundle:contabilidad/indexContabilidad.html.twig', array(
     
        ));
    }

     /**
     * Lists all Contabilidad entities.
     *
     * @Route("/reportes", name="dashboard_reportes",options={"expose"=true})
     * @Method("GET")
     */
      public function indexReportesAction()
    {
 
        return $this->render('ERPCRMBundle:contabilidad/indexReportes.html.twig', array(
     
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
     * @Route("/abonos/nuevo", name="nuevo_abono_index",options={"expose"=true})
     * @Method("GET")
     */
    public function NuevoAbonoAction(Request $request)
    {


        return $this->render('ERPCRMBundle:contabilidad/nuevoAbono.html.twig', array(

        ));
    }
    
    
      /**
     *
     * @Route("/comisionPorCliente", name="comision_por_cliente",options={"expose"=true})
     * @Method("GET")
     */
    public function ComisionPorClienteAbonoAction(Request $request)
    {


        return $this->render('ERPCRMBundle:contabilidad/indexComision.html.twig', array(

        ));
    }
    
    
       
      /**
     *
     * @Route("/clientesConMasVentas", name="clientesConMasVentas",options={"expose"=true})
     * @Method("GET")
     */
    public function ClienteConMasVentasAction(Request $request)
    {

        return $this->render('ERPCRMBundle:contabilidad/indexClienteConMasVentas.html.twig', array(

        ));
        
    }
    
    
    
    
    
    
    
    
    
    
    
     /**
     *
     * @Route("/cuentasPorCobrar", name="cuentasPorCobrar",options={"expose"=true})
     * @Method("GET")
     */
    public function CuentasPorCobrarAction(Request $request)
    {


        return $this->render('ERPCRMBundle:contabilidad/indexCuentasPorCobrar.html.twig', array(

        ));
    }
    
     /**
     *
     * @Route("/ingresosPorProductos", name="ingresosPorProductos",options={"expose"=true})
     * @Method("GET")
     */
    public function IngresosPorProductoAction(Request $request)
    {


        return $this->render('ERPCRMBundle:contabilidad/indexIngresosPorProductos.html.twig', array(

        ));
    }
    
    
    
    /**
     * @Route("/abonos/edicion/{id}", name="editarAbonos", options={"expose"=true})
     * @Method("GET")
     */
    public function LlamarEdicionAbonoAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $abono = $em->getRepository('ERPAdminBundle:Abono')->findById($id);
     
        
        return $this->render('ERPCRMBundle:contabilidad/edicionAbono.html.twig', array(
            'abono' => $abono
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
        
        
        
        $ordenamientoVariable = $request->query->get('order');
        

        $columna = $ordenamientoVariable[0]['column'];
        $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
        
        if ($columna=='0'){
           
               $orden=" enc.id ".$tipoOrdenamiento;
                     
        }else if ($columna=='1'){
            
              $orden=" cli.codigo ".$tipoOrdenamiento;
            
        }else if ($columna=='2'){
            $x="fecha_registro_cliente";
         $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else  if ($columna=='3'){
         $x="fecha_registro_sistema";
         $orden="enc.".$x." ".$tipoOrdenamiento;

            
        }
        
        
       
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
                . "concat_ws(enc.id, '<i class=\" colorAnclas fa fa-file-pdf-o verPDFAbono\" id=\"', '\" title=\"Ver PDF\"></i>'  ) as link "
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
           
            $sql.="and enc.fecha_registro_cliente >= '$fechafin' and enc.fecha_registro_cliente <= '$fechaini' ";
        }

          $sql.=  "ORDER BY ".$orden
                     . " LIMIT $start, $longitud ";
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
                . "concat_ws(enc.id, '<i class=\" colorAnclas fa fa-file-pdf-o verPDFAbono\" id=\"', '\" title=\"Ver PDF\"></i>'  ) as link "
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
           $sql2.="and enc.fecha_registro_cliente >= '$fechafin' and enc.fecha_registro_cliente <= '$fechaini' ";
        }
        
           $sql2.=  "ORDER BY ".$orden
                     . " LIMIT $start, $longitud ";
        
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
                           . " AND (enc.estado=4 OR enc.estado=3 OR enc.estado=2)  AND enc.permiso=1";
                   
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
     
    
    
    function llamarTotalDeuda($idCliente){
        
              $em = $this->getDoctrine()->getManager();
             $sql = "SELECT SUM(monto) as total  from encabezado_orden enc"
                     . " INNER JOIN  cliente cli ON enc.crm_cliente_id=cli.id "
                     . "WHERE enc.crm_cliente_id=".$idCliente
                      . " AND (enc.estado=4 OR enc.estado=3 OR enc.estado=2) AND enc.permiso=1 AND cli.estado=1";
                   
                   $sqlAbono = "SELECT SUM(monto_abono) as totalAbono  from abono enc  "
                            . "INNER JOIN  cliente cli  ON enc.id_cliente=cli.id"
                           . " WHERE enc.id_cliente=".$idCliente. " AND cli.estado=1";
                           

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
        
            return $total;
        
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

            $totalDueuda=  $this->llamarTotalDeuda($idCliente);
            
            
            if ($montoAbono<=$totalDueuda){
                
            $fechaRegistroCliente = $request->get('fechaRegistroCliente'); 
            $descripcion = $request->get('descripcion');
            $tipoPago = $request->get('tipoPago');
            $montoAbono = $request->get('montoAbono');
            $cliente= $this->getDoctrine()->getRepository('ERPAdminBundle:Cliente')->findById($idCliente);                    

            $objeto = new Abono();
            $objeto->setMontoAbono($montoAbono);
            $objeto->setFechaRegistroCliente(new \DateTime($fechaRegistroCliente));
            $objeto->setFechaRegistroSistema(new \DateTime());
            $objeto->setCliente($cliente[0]);
            $objeto->setDescripcion($descripcion);
            $objeto->setTipoPago($tipoPago);
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
            
            
            $totalDueuda=  $this->llamarTotalDeuda($idCliente);
            if ($montoAbono<=$totalDueuda){
                
                    $idDetalle= $request->get('idDetalle'); 
                    $numero = str_replace('<div class="text-right">', '', $idDetalle);
                    $numero = str_replace('</div>', '', $numero);
                    $fechaRegistroCliente = $request->get('fechaRegistroCliente'); 
                    $montoAbono = $request->get('montoAbono');
                    $descripcion = $request->get('descripcion');
                    $tipoPago = $request->get('tipoPago');
                    
                    
                    
                    $objeto = $this->getDoctrine()->getRepository('ERPAdminBundle:Abono')->findById($numero);
                    $cliente= $this->getDoctrine()->getRepository('ERPAdminBundle:Cliente')->findById($idCliente); 


                    $objeto[0]->setCliente($cliente[0]);
                    $objeto[0]->setFechaRegistroCliente(new \DateTime($fechaRegistroCliente));
                    $objeto[0]->setMontoAbono($montoAbono);
                    $objeto[0]->setTipoPago($tipoPago);
                    $objeto[0]->setDescripcion($descripcion);
                    $em->merge($objeto[0]);
                    $em->flush();
                    $data['estado']=true;

                
            }else{
                
                $data['estado']=false;
            }
            
             return new Response(json_encode($data)); 

         }

    }
     
    
    //Reporte de de registro de abono 
    
     /**
     *
     *
     * @Route("/verPDFRegistroAbono/{idDetalle}", name="verPDFRegistroAbono", options={"expose"=true})
       * @Method({"GET", "POST"})
     */
    public function verEncabezadoPDF($idDetalle) {
        $em = $this->getDoctrine()->getManager();

         $dqlAbono = "SELECT date_format(abo.fechaRegistroCliente,'%Y-%m-%d') as fechaRegistroCliente, date_format(abo.fechaRegistroSistema,'%Y-%m-%d') as fechaRegistroSistema,"
                                 . " abo.montoAbono as monto, cli.nombre as nombre, cli.codigo as codigo, abo.descripcion as descripcion, abo.tipoPago as tipoPago, cli.id as idCliente"
                                . " FROM ERPAdminBundle:Abono abo "
                                . "JOIN abo.clienteId cli "
                                . "WHERE abo.id = :id ";

            $abono = $em->createQuery($dqlAbono)
                        ->setParameters(array('id'=>$idDetalle))
                        ->getResult();

            $idCliente = $abono[0]['idCliente'];
            $deuda = $this->llamarTotalDeuda($idCliente);
             

        ob_start();
        $html = $this->renderView('ERPCRMBundle:historialventaclienteR/reporteAbonoCliente.html.php', array(
            'abono'=>$abono,
            'deuda'=>$deuda
           
        ));
        $pdf = new \DOMPDF();
        $pdf->set_paper('A4', 'portrait');
        $pdf->load_html($html);
        $pdf->render();
        $pdf->stream('RegistroDeVenta.pdf', array('Attachment' => 0));
        
    } 

    //Metodo que me retorna el reporte de comisiones por cliente
    /**
     *
     *
     * @Route("/verPDFComisiones/{fechaInicio}/{fechaFin}", name="verPDFComisiones", options={"expose"=true})
       * @Method({"GET", "POST"})
     */
    public function VerPDFComisiones($fechaInicio ,$fechaFin) {
        $em = $this->getDoctrine()->getManager();
      

        
         $dqlComision = "SELECT  cli.codigo, cli.nombre, SUM(enc.montoComision) as comision 
                                    FROM  ERPAdminBundle:EncabezadoOrden enc
                                    JOIN enc.crmClienteId cli 
                                    WHERE enc.estado=1 and enc.permiso=1";
           
        if ($fechaInicio !=0 && $fechaFin!=0){
            
             $dqlComision.="and enc.fechaRegistro >= '$fechaInicio' and enc.fechaRegistro <= '$fechaFin' ";
       
            
        }
       
        $dqlComision.=" group by cli.nombre ";
  
            $comision = $em->createQuery($dqlComision)
               ->getResult();


        ob_start();
        $html = $this->renderView('ERPCRMBundle:contabilidadReportes/reporteComisionPorCliente.html.php', array(
            'comision'=>$comision,
            'fechaInicio'=>$fechaInicio,
            'fechaFin'=>$fechaFin
           
        ));
        $pdf = new \DOMPDF();
        $pdf->set_paper('A4', 'portrait');
        $pdf->load_html($html);
        $pdf->render();
        $pdf->stream('ReporteComision.pdf', array('Attachment' => 0));
        
    } 
    
    
    
    
    
       //Metodo que me retorna el reporte de comisiones por cliente
    /**
     *
     *
     * @Route("/verPDFIngresosPorProducto/{fechaInicio}/{fechaFin}", name="verPDFIngresosPorProducto", options={"expose"=true})
       * @Method({"GET", "POST"})
     */
    public function VerPDFIngresosPorProductos($fechaInicio ,$fechaFin) {
        $em = $this->getDoctrine()->getManager();
      

        
         $dqlComision = "SELECT  cli.codigo, cli.nombre, SUM(enc.monto) as montoTotal 
                                    FROM  ERPAdminBundle:EncabezadoOrden enc
                                    JOIN enc.crmClienteId cli 
                                    WHERE enc.estado=1 and enc.permiso=1";
           
        if ($fechaInicio !=0 && $fechaFin!=0){
            
             $dqlComision.="and enc.fechaRegistro >= '$fechaInicio' and enc.fechaRegistro <= '$fechaFin' ";
       
            
        }
       
        $dqlComision.=" group by cli.nombre ";
  
            $monto = $em->createQuery($dqlComision)
               ->getResult();


        ob_start();
        $html = $this->renderView('ERPCRMBundle:contabilidadReportes/reporteIngresosPorProductos.html.php', array(
            'monto'=>$monto,
            'fechaInicio'=>$fechaInicio,
            'fechaFin'=>$fechaFin
           
        ));
        $pdf = new \DOMPDF();
        $pdf->set_paper('A4', 'portrait');
        $pdf->load_html($html);
        $pdf->render();
        $pdf->stream('ReporteComision.pdf', array('Attachment' => 0));
        
    } 
    
    
    
    
    
    //Metodo que me retorna el reporte de comisiones por cliente
    /**
     *
     *
     * @Route("/verPDFCuentasPorCobrar/", name="verPDFCuentasPorCobrar", options={"expose"=true})
       * @Method({"GET", "POST"})
     */
    public function VerPDFCuentasPorCobrarAction() {
        $em = $this->getDoctrine()->getManager();
    $datos =  Array();
         
            $sqlCliente = "Select cli.id, cli.nombre, cli.telefono, cli.movil,  contac.nombre as contacto FROM cliente cli"
                         . " LEFT OUTER JOIN contacto contac on cli.contacto_id=contac.id "
                    . "WHERE categoria='Distribuidor' ";
            $stmt = $em->getConnection()->prepare($sqlCliente);
            $stmt->execute();
            $idClientes = $stmt->fetchAll();
      
 
            $dimension = count($idClientes);
            
            for($i=0;$i<$dimension;$i++){
                
                $idCliente= $idClientes[$i]['id'];
                $totalDeuda = $this->llamarTotalDeuda($idCliente);
                
                if ($totalDeuda>0){
                    $idClientes[$i]['totalDeuda']=$totalDeuda;
                    $datos[]=$idClientes[$i];
                    
                    
                }
            }
  
            
        ob_start();
        $html = $this->renderView('ERPCRMBundle:contabilidadReportes/reporCuentasPorCobrar.html.php', array(
           'datos'=>$datos
           
        ));
        $pdf = new \DOMPDF();
        $pdf->set_paper('A4', 'portrait');
        $pdf->load_html($html);
        $pdf->render();
        $pdf->stream('ReporteComision.pdf', array('Attachment' => 0));
        
    } 
    
    
    
     /**
     *
     *
     * @Route("/verPDFClienteConMasVentas/{fechaInicio}/{fechaFin}", name="verPDFClienteConMasVentas", options={"expose"=true})
       * @Method({"GET", "POST"})
     */
    public function VerPDFClientesConMasVentasProductos($fechaInicio ,$fechaFin) {
        $em = $this->getDoctrine()->getManager();
      

        
         $dqlVenta = "SELECT 	sum(enc.monto) as montos, cli.id, cli.nombre,cli.codigo   FROM ERPAdminBundle:EncabezadoOrden enc
                                INNER JOIN enc.crmClienteId cli 
                                WHERE (enc.estado = 1 OR enc.estado=5) and enc.permiso=1 ";
           
        if ($fechaInicio !=0 && $fechaFin!=0){
            
             $dqlVenta.="and enc.fechaRegistro >= '$fechaInicio' and enc.fechaRegistro <= '$fechaFin' ";
       
            
        }
       
        $dqlVenta.=" group by cli.id ORDER BY montos DESC";
  
            $ventas = $em->createQuery($dqlVenta)
               ->getResult();

        ob_start();
        $html = $this->renderView('ERPCRMBundle:contabilidadReportes/reporteClienteConMasVentas.html.php', array(
            'ventas'=>$ventas,
            'fechaInicio'=>$fechaInicio,
            'fechaFin'=>$fechaFin
           
        ));
        $pdf = new \DOMPDF();
        $pdf->set_paper('A4', 'portrait');
        $pdf->load_html($html);
        $pdf->render();
        $pdf->stream('ReporteComision.pdf', array('Attachment' => 0));
        
    } 
    
    
     
   
    
    
    
    
    
    
    
    
}
