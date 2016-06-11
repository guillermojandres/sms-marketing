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
include_once '../src/ERP/CRMBundle/Resources/dompdf/dompdf_config.inc.php'; 
include_once "../src/ERP/CRMBundle/Resources/phpexcel/lib/PHPExcel/IOFactory.php";
include_once "../src/ERP/CRMBundle/Resources/phpexcel/lib/PHPExcel.php";
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
     * @Route("/verFactura/{idDetalle}", name="verFactura", options={"expose"=true})
       * @Method({"GET", "POST"})
     */
    public function verEncabezadoPDF($idDetalle) {
        $em = $this->getDoctrine()->getManager();
//        $encabezado = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->findById($idDetalle) ;
         $dqlEncabezado = "SELECT enc.numeroOrden, date_format(enc.fechaRegistro,'%Y-%m-%d') as fechaRegistro,enc.estado,enc.tipoPago, enc.monto, cli.nombre, cli.codigo, enc.montoComision FROM ERPAdminBundle:EncabezadoOrden enc "
                    . "JOIN enc.crmClienteId cli "
                    . "WHERE enc.permiso =1 and enc.id = :id ";

            $encabezado = $em->createQuery($dqlEncabezado)
                        ->setParameters(array('id'=>$idDetalle))
                        ->getResult();


        
        $detalleOrden = $this->llamarDetalleOrden($idDetalle);
        ob_start();
        $html = $this->renderView('ERPCRMBundle:historialventaclienteR/reporteVentaCliente.html.php', array(
            'encabezado'=>$encabezado,
            'detalleOrden'=>$detalleOrden
           
        ));
        $pdf = new \DOMPDF();
        $pdf->set_paper('A4', 'portrait');
        $pdf->load_html($html);
        $pdf->render();
        $pdf->stream('RegistroDeVenta.pdf', array('Attachment' => 0));
        
    }
    
    function llamarDetalleOrden($idEncabezado) {
        
        
          $em = $this->getDoctrine()->getManager();
           $productos = array();
            $productosId = array();
            $cantidades = array();
            $precios = array();
            $descuentos = array();
            $idsOrden = array();
        
         $dqlProducto = "SELECT  pro.id, pro.nombre  FROM ERPAdminBundle:Orden orden "
                    . "JOIN orden.productoId pro "
                    . "WHERE orden.encabezadoOrdenId = :id ";

            $resultadoProducto = $em->createQuery($dqlProducto)
                        ->setParameters(array('id'=>$idEncabezado))
                        ->getResult();
            
            
            
            
            
             $dqlProductoId = "SELECT  pro.id FROM ERPAdminBundle:Orden orden "
                    . "JOIN orden.productoId pro "
                    . "WHERE orden.encabezadoOrdenId = :id ";

            $resultadoProductoId = $em->createQuery($dqlProductoId)
                        ->setParameters(array('id'=>$idEncabezado))
                        ->getResult();
            
 
            
             $dqlPrecio = "SELECT orden.precio  FROM ERPAdminBundle:Orden orden "
                    . "WHERE orden.encabezadoOrdenId = :id ";

            $resultadoPrecio = $em->createQuery($dqlPrecio)
                        ->setParameters(array('id'=>$idEncabezado))
                        ->getResult();
            
            $dqlCantidad = "SELECT  orden.cantidad  FROM ERPAdminBundle:Orden orden "
                    . "WHERE orden.encabezadoOrdenId = :id ";

            $resultadoCantidad = $em->createQuery($dqlCantidad)
                        ->setParameters(array('id'=>$idEncabezado))
                        ->getResult();
            
            
            $dqlDescuento = "SELECT orden.descuento  FROM ERPAdminBundle:Orden orden "
                    . "WHERE orden.encabezadoOrdenId = :id ";

            $resultadoDescuento = $em->createQuery($dqlDescuento)
                        ->setParameters(array('id'=>$idEncabezado))
                        ->getResult();
            
            
             $dqlIdOrden = "SELECT  orden.id  FROM ERPAdminBundle:Orden orden "
                    . "WHERE orden.encabezadoOrdenId = :id ";

            $resultadoIdOrden= $em->createQuery($dqlIdOrden)
                        ->setParameters(array('id'=>$idEncabezado))
                        ->getResult();
            
            
              $dimension = count($resultadoProducto);
                
                for ($i=0;$i<$dimension;$i++){

                        $productos[$i]=$resultadoProducto[$i]['nombre'];
                          $precios[$i]=$resultadoPrecio[$i]['precio'];
                            $cantidades[$i]=$resultadoCantidad[$i]['cantidad'];
                              $descuentos[$i]=$resultadoDescuento[$i]['descuento'];
                               $idsOrden[$i]=$resultadoIdOrden[$i]['id'];
                                  $productosId[$i]=$resultadoProductoId[$i]['id'];
                }

                 $data['estado']=true;
                 $data['precio']=$precios;
                 $data['nombre']=$productos;
                 $data['idNombre']=$productosId;
                 $data['cantidad']=$cantidades;
                 $data['descuento']=$descuentos;
                 $data['idOrden']=$idsOrden;

                 return $data;

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
                . "concat_ws(cli.nombre, '<div class=\"text-left\">', '</div>') as nombre, "
                . "concat_ws(cli.codigo, '<div class=\"text-center\">', '</div>') as codigo, "
                . "concat_ws(DATE_FORMAT(enc.fecha_registro,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro, "
                . "CASE 
                     WHEN enc.estado='1' THEN 'Pago Recibido'
                     WHEN enc.estado='2' THEN 'Procesado'
                     WHEN enc.estado='3' THEN 'Procesado'
                     WHEN enc.estado='4' THEN 'En camino'
                     WHEN enc.estado='5' THEN 'Completado'
                    END as estado, "
                . "concat_ws(enc.tipo_venta, '<div class=\"text-center\">', '</div>') as tipoVenta, "
                . "concat_ws(enc.tipo_pago, '<div class=\"text-center\">', '</div>') as tipo_pago, "
                . "concat_ws(enc.monto, '<div class=\"text-center\">', '</div>') as monto, "
                . "concat_ws(enc.id, '<i class=\" colorAnclas fa fa-file-pdf-o verPDF\" id=\"', '\" title=\"Ver PDF\"></i>&nbsp;&nbsp;<i class=\" colorAnclas fa fa-file-excel-o verExcel\" id=\"', '\" title=\"Descargar excel\"></i>'  ) as link "
                . "FROM encabezado_orden enc  inner join cliente cli on enc.crm_cliente_id = cli.id "
                . "WHERE 1 = 1 AND enc.permiso =1 ";

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
        $rsm->addScalarResult('nombre','nombre');
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
                . "concat_ws(cli.nombre, '<div class=\"text-left\">', '</div>') as nombre, "
                . "concat_ws(cli.codigo, '<div class=\"text-center\">', '</div>') as codigo, "
                . "concat_ws(DATE_FORMAT(enc.fecha_registro,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_registro, "
                . "concat_ws(enc.estado, '<div class=\"text-center\">', '</div>') as estado, "
                . "concat_ws(enc.tipo_venta, '<div class=\"text-center\">', '</div>') as tipoVenta, "
                . "concat_ws(enc.tipo_pago, '<div class=\"text-center\">', '</div>') as tipo_pago, "
                . "concat_ws(enc.monto, '<div class=\"text-center\">', '</div>') as monto, "
                . "concat_ws(enc.id, '<i class=\" colorAnclas fa fa-file-pdf-o verPDF\" id=\"', '\" title=\"Ver PDF\"></i>') as link "
                . "FROM encabezado_orden enc  inner join cliente cli on enc.crm_cliente_id = cli.id "
                . "WHERE 1 = 1 AND enc.permiso =1 ";

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
        $rsm2->addScalarResult('nombre','nombre');
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
                    where (upper(cli.codigo)  LIKE upper('%".$busqueda."%') OR upper(cli.nombre)  LIKE upper('%".$busqueda."%') ) AND cli.categoria = 'Distribuidor' AND cli.estado=1
                    order by cli.codigo asc
                    limit 0, 10";
               
        $rsm->addScalarResult('abogadoid','abogadoid');
        $rsm->addScalarResult('nombres','nombres');
        $rsm->addScalarResult('codigo','codigo');

        $abogado['data'] = $em->createNativeQuery($sql, $rsm)
                                  ->getResult();
       
        return new Response(json_encode($abogado));
    }
     
    
    //Funcion para llamar excel dentro para los valores de los registros de las ventas
     /**
     *
     *
     * @Route("/verExcel/{idDetalle}", name="verExcel", options={"expose"=true})
       * @Method({"GET", "POST"})
     */
    function llamarExcel($idDetalle) {
          $em = $this->getDoctrine()->getManager();
//        $encabezado = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->findById($idDetalle) ;
         $dqlEncabezado = "SELECT date_format(enc.fechaRegistro,'%Y-%m-%d') as fechaRegistro,enc.estado,enc.tipoPago, enc.monto, enc.montoComision, cli.nombre, cli.codigo FROM ERPAdminBundle:EncabezadoOrden enc "
                    . "JOIN enc.crmClienteId cli "
                    . "WHERE enc.permiso =1 and enc.id = :id ";

         $encabezado = $em->createQuery($dqlEncabezado)
                        ->setParameters(array('id'=>$idDetalle))
                        ->getResult();
  

        $detalleOrden = $this->llamarDetalleOrden($idDetalle);
        
        
        
        
        
        $objPHPExcel = new \PHPExcel(); //nueva instancia

	$objPHPExcel->getProperties()->setCreator("Digitality Garage"); //autor
	$objPHPExcel->getProperties()->setTitle("Registros de venta"); //titulo

	
        
	
	date_default_timezone_set('America/El_Salvador');
	
	if (PHP_SAPI == 'cli')
		die('Este archivo solo se puede ver desde un navegador web');
	
	// Se asignan las propiedades del libro
	$objPHPExcel->getProperties()->setCreator("Digitality Garage") // Nombre del autor
		->setLastModifiedBy("Digitality Garage") //Ultimo usuario que lo modificó
		->setTitle("Reporte Excel con PHP y MySQL") // Titulo
		->setSubject("Reporte Excel con PHP y MySQL") //Asunto
		->setDescription("Reporte de ventas") //Descripción
		->setKeywords("Reporte ventas") //Etiquetas
		->setCategory("Reporte excel"); //Categorias
	
	$tituloReporte = "Reporte de venta";
	$titulosColumnas = array( 'FECHA DE REGISTRO','TIPO DE PAGO','NOMBRE CLIENTE','MONTO TOTAL ($)','ESTADO DE VENTA','MONTO COMISION($)');
	$titulosColumnas2 = array( 'PRODUCTO','PRECIO','CANTIDAD','SUB TOTAL');
	// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
	$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A1:D2');
	 
	// Se agregan los titulos del reporte
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1',$tituloReporte) // Titulo del reporte
		->setCellValue('A3',  $titulosColumnas[0])  
                                    ->setCellValue('B3',  $titulosColumnas[1])  //Titulo de las columnas
		->setCellValue('C3',  $titulosColumnas[2])
                                      ->setCellValue('C16',  $titulosColumnas[3])
                                    ->setCellValue('D3',  $titulosColumnas[4])
                                        ->setCellValue('C15',  $titulosColumnas[5])
                                      ->setCellValue('A9',  $titulosColumnas2[0])
                                            ->setCellValue('B9',  $titulosColumnas2[1])
                                            ->setCellValue('C9',  $titulosColumnas2[2])
                                            ->setCellValue('D9',  $titulosColumnas2[3]);
		//->setCellValue('D3',  $titulosColumnas[3]);
	
	//Donde se setean los valores de del encabezado
                    $estado ="";
                        if($encabezado[0]["estado"]==1){
                            
                                         $estado = "Pago Recibido";
                                    }elseif($encabezado[0]["estado"]==2){
                                        $estado = "En proceso";
                                        
                                    }elseif($encabezado[0]["estado"]==3){
                                        $estado = "Procesado";
                                        
                                    } elseif($encabezado[0]["estado"]==4){
                                        $estado = "En camino";
                                        
                                    }elseif($encabezado[0]["estado"]==5){
                                        $estado = "Completado";
                                        
                                    }   
        
        
        
                                $objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A4', $encabezado[0]['fechaRegistro'])  
                                  ->setCellValue('C4', $encabezado[0]['nombre'])
                                        ->setCellValue('D16', $encabezado[0]['monto'])
                                        ->setCellValue('B4', $encabezado[0]['tipoPago'])
                                        ->setCellValue('D4',$estado) 
                                           ->setCellValue('D15',$encabezado[0]['montoComision'] )  ;
        
        
 
	 $v = 10; //Numero de fila donde se va a comenzar a rellenar
                    
          $dimension = count($detalleOrden['nombre']);
              
              for ($i=0;$i<$dimension;$i++){
                  $subTotal1= ($detalleOrden['cantidad'][$i]*$detalleOrden['precio'][$i]);
                  
                  $comision = $subTotal1-($subTotal1*($detalleOrden['descuento'][$i]/100));
                  $subTotal = $subTotal1-$comision;
                  
                   $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$v,$detalleOrden['nombre'][$i])
                           ->setCellValue('B'.$v,number_format($detalleOrden['precio'][$i],2))
                             ->setCellValue('C'.$v,$detalleOrden['cantidad'][$i])
                               ->setCellValue('D'.$v, $subTotal);
                   $v++;          
                   
              }

                             
	$estiloTituloReporte = array(
		'font' => array(
			'name'      => 'Verdana',
			'bold'      => true,
			'italic'    => false,
			'strike'    => false,
			'size' =>16,
			'color'     => array(
				'rgb' => 'FFFFFF'
			)
		),
		'fill' => array(
			'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array(
				'argb' => '29b2b2')
		),
		'borders' => array(
			'allborders' => array(
				'style' => \PHPExcel_Style_Border::BORDER_NONE
			)
		),
		'alignment' => array(
			'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'rotation' => 0,
			'wrap' => TRUE
		)
	);
	 
	$estiloTituloColumnas = array(      
		'font' => array(
			'name'      => 'Verdana',
			'bold'      => true,
			'italic'    => false,
			'strike'    => false,
			'size' =>12,
			'color'     => array(
				'rgb' => 'FFFFFF'
			)
		),
		'fill' => array(
			'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array(
				'argb' => '29b2b2')
		),
		'borders' => array(
			'allborders' => array(
				'style' => \PHPExcel_Style_Border::BORDER_NONE
			)
		),
		'alignment' => array(
			'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
			'rotation' => 0,
			'wrap' => TRUE
		)
	);
	 
	$estiloInformacion = new \PHPExcel_Style();
	
	$estiloInformacion->applyFromArray( array(
		'font' => array(
			'name'  => 'Arial',
			'color' => array(
				'rgb' => '000000'
			)
		),
		'fill' => array(
		'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array(
				'argb' => 'FFFFDA')
		),
		'borders' => array(
			'left' => array(
				'style' => \PHPExcel_Style_Border::BORDER_THIN ,
			'color' => array(
					'rgb' => 'FFFFFF'
				)
			)
		)
	));
        
        
        
                $estiloInformacion2 = new \PHPExcel_Style();
	
	$estiloInformacion2->applyFromArray( array(
		'font' => array(
			'name'  => 'Arial',
			'color' => array(
				'rgb' => '000000'
			)
		),
		'fill' => array(
		'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array(
				'argb' => '29b2b2')
		),
		'borders' => array(
			'left' => array(
				'style' => \PHPExcel_Style_Border::BORDER_THIN ,
			'color' => array(
					'rgb' => 'FFFFFF'
				)
			)
		)
	));
                
        $estiloInformacion3 = new \PHPExcel_Style();
	
	$estiloInformacion3->applyFromArray( array(
		'font' => array(
			'name'  => 'Arial',
			'color' => array(
				'rgb' => '000000'
			)
		),
		'fill' => array(
		'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array(
				'argb' => 'FFFFDA')
		),
		'borders' => array(
			'left' => array(
				'style' => \PHPExcel_Style_Border::BORDER_THIN ,
			'color' => array(
					'rgb' => 'FFFFFF'
				)
			)
		)
	));
                           
        
        
        
        

            $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
            $objPHPExcel->getActiveSheet()->getStyle('A3:D4')->applyFromArray($estiloTituloColumnas);
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion2, "C15:D16");
             $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion2, "A9:D9");
           
            $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A10:D".($v));

            for($i = 'A'; $i <= 'D'; $i++){
                    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
            }
	
	// Se asigna el nombre a la hoja
	$objPHPExcel->getActiveSheet()->setTitle('Registro de venta');
	 
	// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
	$objPHPExcel->setActiveSheetIndex(0);
	 
	// Inmovilizar paneles
	//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
	$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
	
	// Save Excel 2007 file
	#echo date('H:i:s') . " Write to Excel2007 format\n";
	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	ob_end_clean();
	// We'll be outputting an excel file
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="ingreso'.'_'.date("d-m-Y_H-i-s").'.xlsx"');
	$objWriter->save('php://output');
        
        
        
    }   
     
     
     
     
     
     
    
    
    
    
}
