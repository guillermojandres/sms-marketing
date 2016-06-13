<?php
namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmCliente;
use ERP\AdminBundle\Entity\Cliente;
use ERP\AdminBundle\Entity\Orden;
use ERP\AdminBundle\Entity\EncabezadoOrden;
use ERP\AdminBundle\Form\CrmClienteType;
use Symfony\Component\HttpKernel\Exception;
use Doctrine\ORM\Query\ResultSetMapping;


/**
 * CrmCliente controller.
 *
 * @Route("/admin/CRM/cliente")
 */
class CrmClienteController extends Controller
{
    /**
     * Lists all CrmCliente entities.
     *
     * @Route("/clientes/", name="cliente_index", options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $crmClientes = $em->getRepository('ERPAdminBundle:CrmCliente')->findAll();
        
        $crmCliente = new CrmCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClienteType', $crmCliente);
        $form->handleRequest($request);

        return $this->render('ERPCRMBundle:crmcliente/index.html.twig', array(
             'crmCliente' => $crmCliente,
            'crmClientes' => $crmClientes,
             'form' => $form->createView(),
        ));
    }

    
    
     /**
     * Creates a new CrmCliente entity.
     *
     * @Route("/new", name="cliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmCliente = new CrmCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClienteType', $crmCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmCliente);
            $em->flush();

            return $this->redirectToRoute('admin_cliente_show', array('id' => $crmCliente->getId()));
        }

        return $this->render('ERPCRMBundle:crmcliente/new.html.twig', array(
            'crmCliente' => $crmCliente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CrmCliente entity.
     *
     * @Route("/{id}", name="admin_cliente_show")
     * @Method("GET")
     */
    public function showAction(CrmCliente $crmCliente)
    {
        $deleteForm = $this->createDeleteForm($crmCliente);

        return $this->render('crmcliente/show.html.twig', array(
            'crmCliente' => $crmCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CrmCliente entity.
     *
     * @Route("/clientes/{id}/edit", name="cliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmCliente $crmCliente)
    {
        $deleteForm = $this->createDeleteForm($crmCliente);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CrmClienteType', $crmCliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmCliente);
            $em->flush();

            return $this->redirectToRoute('admin_cliente_edit', array('id' => $crmCliente->getId()));
        }

        return $this->render('ERPCRMBundle:crmcliente/edit.html.twig', array(
            'crmCliente' => $crmCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CrmCliente entity.
     *
     * @Route("/{id}", name="admin_cliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmCliente $crmCliente)
    {
        $form = $this->createDeleteForm($crmCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmCliente);
            $em->flush();
        }

        return $this->redirectToRoute('admin_cliente_index');
    }

    /**
     * Creates a form to delete a CrmCliente entity.
     *
     * @param CrmCliente $crmCliente The CrmCliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmCliente $crmCliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cliente_delete', array('id' => $crmCliente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     /**
     * 
     *
     * @Route("/clientepotencial/data", name="cliente_datas")
     */
    public function dataClientelAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CrmCliente();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CrmCliente')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered']= count($territoriosTotal);
        
        $territorio['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        if($busqueda['value']!=''){
        
                    $dql = "SELECT cli.id , cli.nombreCompleto  ,cli.sitioWeb, cat.nombre as nombrecat,cli.datosCliente  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcliente\" id=\"',cli.id), '\">' as link FROM ERPAdminBundle:CrmCliente cli "
                        . "JOIN cli.categoriaCliente cat "
                        . "WHERE upper(cli.nombreCompleto)  LIKE upper(:busqueda) OR upper(cat.nombre)  LIKE upper(:busqueda) AND cli.estado=1 "
                        . "ORDER BY cli.nombreCompleto DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                    $dql = "SELECT cli.id , cli.nombreCompleto  ,cli.sitioWeb, cat.nombre as nombrecat,cli.datosCliente  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcliente\" id=\"',cli.id), '\">' as link FROM ERPAdminBundle:CrmCliente cli "
                        . "JOIN cli.categoriaCliente cat "
                        . "WHERE upper(cli.nombreCompleto)  LIKE upper(:busqueda) OR upper(cat.nombre)  LIKE upper(:busqueda) AND cli.estado=1 "
                        . "ORDER BY cli.nombreCompleto DESC ";
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT cli.id , cli.nombreCompleto  ,cli.sitioWeb, cat.nombre as nombrecat,cli.datosCliente ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcliente\" id=\"',cli.id), '\">' as link FROM ERPAdminBundle:CrmCliente cli "
                   . "JOIN cli.categoriaCliente cat WHERE  cli.estado=1 "
                   . "ORDER BY cli.nombreCompleto DESC ";
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
        }
        
        
        return new Response(json_encode($territorio));
    }
    

    
    
    /**
     * 
     *
     * @Route("/cliente/distribuidor/data", name="cliente_distribuidores_data")
     */
    public function DataClienteDistribuidorAction(Request $request)
    {
        
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        $entity = new Cliente();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:Cliente')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered']= count($territoriosTotal);
        
        $territorio['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        
         if($busqueda['value']!=''){
        
                    $dql = "SELECT cli.id as id ,cli.codigo as codigo , cli.nombre as nombreCompleto, cli.direccion as direccion,cli.credito as credito FROM ERPAdminBundle:Cliente cli "
                        . "WHERE (upper(cli.nombre)  LIKE upper(:busqueda) OR cli.codigo  LIKE upper(:busqueda) ) AND cli.categoria='Distribuidor'  AND cli.estado=1 "
                        . "ORDER BY cli.nombre DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                    $dql = "SELECT cli.id as id,cli.codigo as codigo, cli.nombre as nombreCompleto, cli.direccion as direccion,cli.credito as credito FROM  ERPAdminBundle:Cliente cli "
                        . "WHERE (upper(cli.nombre)  LIKE upper(:busqueda) OR cli.codigo  LIKE upper(:busqueda) ) AND cli.categoria='Distribuidor'  AND cli.estado=1 "
                        . "ORDER BY cli.nombre DESC ";
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT cli.id as id,cli.codigo as codigo , cli.nombre as nombreCompleto, cli.direccion as direccion,cli.credito as credito FROM  ERPAdminBundle:Cliente cli "
                   . "WHERE  cli.categoria='Distribuidor'  AND cli.estado=1 "
                   . "ORDER BY cli.nombre DESC ";
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
        }
       
        
        return new Response(json_encode($territorio));
    }
    
    
     /**
     *
     * @Route("/clientes/distribuidores", name="cliente_distribuidores_index",options={"expose"=true})
     * @Method("GET")
     */
    public function DistribuidoresAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $crmClientes = $em->getRepository('ERPAdminBundle:CrmCliente')->findAll();
        
        $crmCliente = new CrmCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClienteType', $crmCliente);
        $form->handleRequest($request);

        return $this->render('ERPCRMBundle:crmcliente/indexclientesdistribuidores.html.twig', array(
             'crmCliente' => $crmCliente,
            'crmClientes' => $crmClientes,
             'form' => $form->createView(),
        ));
    }
    
    
    
      /**
     * @Route("/seleccionarCliente/", name="seleccionarCliente", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function SeleccionarClienteAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
           
            $id = $request->get('id'); 

            $dqlPer = "SELECT cli.nombre AS nombre, cli.direccion as direccion,cli.telefono as telefono FROM ERPAdminBundle:Cliente cli WHERE"
                   . " cli.id= :id ";

            $resultadoPersona = $em->createQuery($dqlPer)
                        ->setParameters(array('id'=>$id))
                        ->getResult();
            
              
            
            $rp=$resultadoPersona[0]['nombre'];
            $telefono=$resultadoPersona[0]['telefono'];
            $direccion = $resultadoPersona[0]['direccion'];
                 $data['estado']=true;
                 $data['nombre']=$rp;
                 $data['telefono']=$telefono;
                 $data['direccion']=$direccion;
            
            
                
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
    
  
    
      /**
     * @Route("/buscarPrecioProducto/", name="buscarPrecioProducto", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function buscarPrecioAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
           
            $idProducto = $request->get('idProducto'); 
            $idCliente = $request->get('idCliente'); 
            

            $dqlPer = "SELECT pro.precio AS precio FROM ERPAdminBundle:BeardProducto pro WHERE"
                   . " pro.id= :id ";

            $resultadoPersona = $em->createQuery($dqlPer)
                        ->setParameters(array('id'=>$idProducto))
                        ->getResult();

            
            $sql = "SELECT ord.descuento as descuento FROM orden ord
                            WHERE ord.id=(
                            SELECT  max(ord.id) FROM encabezado_orden enc  INNER JOIN orden ord 
                            ON  enc.id=ord.encabezado_orden_id
                            WHERE enc.crm_cliente_id=".$idCliente." AND ord.id_producto=".$idProducto.")";
                   
                    $stmt = $em->getConnection()->prepare($sql);
                    $stmt->execute();
                    $descuento = $stmt->fetchAll();
                 
              
               if (count($descuento)==0){
                   $ultimoDecuento=0;

               }else{
                   $ultimoDecuento=$descuento[0]['descuento'];
               }
 
                $rp=$resultadoPersona[0]['precio'];
        
                 $data['estado']=true;
                 $data['precio']=$rp;
                 $data['descuento']=$ultimoDecuento;
            
            
                
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
    
 
    
    
    
     /**
     * @Route("/insertarDatosRegistroCompra/", name="insertarDatosRegistroCompra", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function InsertarDatosRegistroCompraAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
           $em = $this->getDoctrine()->getManager();  
         if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            $idCliente= $request->get('idCliente');
            

            $fechaRC= $request->get('fechaRC');
            $tipoPago=$request->get('tipoPago');
            $totalRC= $request->get('totalRC');
            $productos= $request->get('productos');
            $precios= $request->get('precios');
            $cantidades= $request->get('cantidades');
            $descuentos= $request->get('descuentos');
            $estado = $request->get('estado');
            $montoComision = $request->get('totalComision');
            $dimension = count($productos);
 
           $cliente= $this->getDoctrine()->getRepository('ERPAdminBundle:Cliente')->findById($idCliente); 
         
           $objeto = new EncabezadoOrden();
           $objeto->setCrmCliente($cliente[0]);
           $objeto->setMonto($totalRC);
           $objeto->setTipoPago($tipoPago);
           $objeto->setEstado($estado);
           $objeto->setFechaRegistro(new \DateTime($fechaRC));
           $objeto->setTipoVenta('Offline'); 
           $objeto->setMontoComision($montoComision);
           $numeroOrden=  $this->generarCorrelativoVenta();
           $objeto->setNumeroOrden($numeroOrden);
           $objeto->setPermiso(1);
           $em->persist($objeto);
           $em->flush();
           $idEncabezado = $this->getDoctrine()->getRepository('ERPAdminBundle:EncabezadoOrden')->find($objeto->getId());
          
            for($i=0;$i<$dimension;$i++){
              $productoId= $this->getDoctrine()->getRepository('ERPAdminBundle:BeardProducto')->findById($productos[$i]);                    
              $objeto2 = new Orden();
              $objeto2->setEncabezadoOrden($idEncabezado);
              $objeto2->setCantidad($cantidades[$i]);
              $objeto2->setPrecio($precios[$i]);
              $objeto2->setIdProducto($productos[$i]);
              $objeto2->setDescuento($descuentos[$i]);
              $objeto2->setProductoId($productoId[0]);
              $em->persist($objeto2);
               $em->flush();
            }
            
  
            $data['estado']=true;


            return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
    
    
     public function generarCorrelativoVenta(){
    
       
        $em = $this->getDoctrine()->getManager();
        $dqlNumerocorrelativo = "SELECT COUNT(u.id) as numero FROM ERPAdminBundle:EncabezadoOrden u"
                . " WHERE u.numeroOrden like '%NRV%' ";
        $resultCorrelativo = $em->createQuery($dqlNumerocorrelativo)->getArrayResult();
        $numero_base = $resultCorrelativo[0]['numero'];
        
        
       $primerLetras="NRV"; 
       $valor ="";
        
       $numero = $numero_base+1;
        switch (strlen($numero_base)){
            case 1:
                $valor=$primerLetras.="00000".$numero;
            break;
            case 2:    
                $valor=$primerLetras.="0000".$numero;
            break;
            case 3:    
                 $valor=$primerLetras.="000".$numero;
            break;
            case 4:    
                $valor=$primerLetras.="00".$numero;
            break;
            case 5: 
                $valor=$primerLetras.="00".$numero;
            break;
           case 6: 
                 $valor=$primerLetras.=$numero;
            break;
            
              
            
        }
        return $valor;
     }
    
    
    
    
     /**
     * 
     *
     * @Route("/registro/compra/data", name="registro_compra_data")
     */
    public function RegistroCompraAction(Request $request)
    {
        
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        $entity = new EncabezadoOrden();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered']= count($territoriosTotal);
        
        $territorio['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        
        
         $ordenamientoVariable = $request->query->get('order');
        

        $columna = $ordenamientoVariable[0]['column'];
        $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
        
        if ($columna=='0'){
            
            $x="id";
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else if ($columna=='1'){
            $x='numeroOrden';
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else  if ($columna=='2'){
            
           $orden=" cli.nombre ".$tipoOrdenamiento;

            
        }else{
              $x='monto';
                $orden="enc.".$x." ".$tipoOrdenamiento;
        }
        


         if($busqueda['value']!=''){
        
                    $dql = "SELECT enc.numeroOrden, enc.id as id, enc.tipoVenta as tipoVenta, enc.monto as monto,enc.estado as estado,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                        . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=3 AND enc.permiso =1 "
                        . "ORDER BY ".$orden;
                        
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                        $dql = "SELECT enc.numeroOrden, enc.id as id, enc.tipoVenta as tipoVenta, enc.monto as monto,enc.estado as estado,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                         . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=3 AND enc.permiso =1 "
                         . "ORDER BY ".$orden;
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
                       $territorio['recordsFiltered']= count($territorio['data']);
        }
        else{
             $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.estado as estado,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli WHERE  enc.estado=3 AND enc.permiso =1 "
                          . "ORDER BY ".$orden;
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
                $territorio['recordsFiltered']= count($territorio['data']);
        }
       

        return new Response(json_encode($territorio));
    }
    
    
    
    
       /**
     *
     * @Route("/clientes/registroCompras", name="cliente_registroCompras_index",options={"expose"=true})
     * @Method("GET")
     */
    public function RegistrocComprasAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $crmClientes = $em->getRepository('ERPAdminBundle:CrmCliente')->findAll();
        
        $crmCliente = new CrmCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClienteType', $crmCliente);
        $form->handleRequest($request);

        return $this->render('ERPCRMBundle:crmcliente/indexregistroscompras.html.twig', array(
             'crmCliente' => $crmCliente,
            'crmClientes' => $crmClientes,
             'form' => $form->createView(),
        ));
    }
    
    
    
      /**
     * @Route("/buscarDestalleRegistroCompra/", name="buscarDestalleRegistroCompra", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function BuscarDestalleRegistroCompraAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            $productos = array();
            $productosId = array();
            $cantidades = array();
            $precios = array();
            $descuentos = array();
            $idsOrden = array();

            $em = $this->getDoctrine()->getManager();
           
            $idEncabezado = $request->get('idEncabezado'); 
            
              
             $dqlEncabezado = "SELECT date_format(enc.fechaRegistro,'%Y-%m-%d') as fechaRegistro,enc.estado,enc.tipoPago, enc.montoComision, enc.monto, cli.nombre, cli.id as id FROM ERPAdminBundle:EncabezadoOrden enc "
                    . "JOIN enc.crmClienteId cli "
                    . "WHERE enc.id = :id ";

            $resultadoEncabezado = $em->createQuery($dqlEncabezado)
                        ->setParameters(array('id'=>$idEncabezado))
                        ->getResult();
            
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
                 $data['encabezado']=$resultadoEncabezado;
                 $data['precio']=$precios;
                 $data['nombre']=$productos;
                 $data['idNombre']=$productosId;
                 $data['cantidad']=$cantidades;
                 $data['descuento']=$descuentos;
                 $data['idOrden']=$idsOrden;
                
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
    
      /**
     * @Route("/eliminarDetalleOrden/", name="eliminarDetalleOrden", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function EliminarDetalleOrdenAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
          
         if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
           
            $idDetalleOrden = $request->get('idDetalleOrden'); 
            $idEncabezado = $request->get('idEncabezado');
            
            $objE = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->find($idEncabezado);
            $obj = $em->getRepository('ERPAdminBundle:Orden')->find($idDetalleOrden);
            
            $montoActual = $objE->getMonto();
            $precio=$obj->getPrecio();
            $cantidad = $obj->getCantidad();
            $porcentajeC=$obj->getDescuento();
            $comisionActual =$objE->getMontoComision();
            
            $subtoalRes = $cantidad*$precio;
            $porcentajeRestar=$subtoalRes*$porcentajeC;
            
            $nuevoMontoComision= $comisionActual-$porcentajeRestar;
            $nuevoTotal = $montoActual-$subtoalRes;
            
            
           $objE->setMonto($nuevoTotal);
           $objE->setMontoComision($nuevoMontoComision);
           $em->merge($objE);
           $em->flush();

            $em->remove($obj);
            $em->flush();
           
    
            
             $data['estado']=true;
             
             
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
    
      /**
     * @Route("/editarDatosRegistroCompra/", name="EditarDatosRegistroCompra", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function EditarDatosRegistroCompraAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
           $em = $this->getDoctrine()->getManager();  
         if($isAjax){
//Caso de que los datos simplemente se estan editando
            $em = $this->getDoctrine()->getManager();
            
            $fechaRC= $request->get('fechaRCE');
            $tipoPago=$request->get('tipoPagoE');
            $totalRC= $request->get('totalRCE');
            $idEmcabezado = $request->get('idEncabezado');
                 
            $estado = $request->get('estadoE');
            $orden =  $request->get('ordendeCompraE');
            $totalComision =  $request->get('totalComision');
            
    
            
           $objeto = $this->getDoctrine()->getRepository('ERPAdminBundle:EncabezadoOrden')->findById($idEmcabezado);
           $objeto[0]->setMonto($totalRC);
           $objeto[0]->setTipoPago($tipoPago);
           $objeto[0]->setEstado($estado);
           $objeto[0]->setFechaRegistro(new \DateTime($fechaRC));
           $objeto[0]->setMontoComision($totalComision);
           $em->merge($objeto[0]);
           $em->flush();
            
     
           
            
            $productos= $request->get('productosE');
            $precios= $request->get('preciosE');
            $cantidades= $request->get('cantidadesE');
            $descuentos= $request->get('descuentosE');
            
            
            
          
            
         
            $dimension = count($productos);

            for($i=0;$i<$dimension;$i++){
              $productoId= $this->getDoctrine()->getRepository('ERPAdminBundle:BeardProducto')->findById($productos[$i]);                    
              $objeto2 =  $this->getDoctrine()->getRepository('ERPAdminBundle:Orden')->findById($orden[$i]);                    
              $objeto2[0]->setCantidad($cantidades[$i]);
              $objeto2[0]->setPrecio($precios[$i]);
              $objeto2[0]->setIdProducto($productos[$i]);
              $objeto2[0]->setDescuento($descuentos[$i]);
              $objeto2[0]->setProductoId($productoId[0]);
              $em->merge($objeto2[0]);
               $em->flush();
            }
            
         
    //Caso en el ingreso de nuevos productos dentro de la edicion de un RC        
            
            $productosEN= $request->get('productosENuevo');
            $preciosEN= $request->get('preciosENuevo');
            $cantidadesEN= $request->get('cantidadesENuevo');
            $descuentosEN= $request->get('descuentosENuevo');
            $dimensionEN = count($productosEN);

            
                $EncabezadoN = $this->getDoctrine()->getRepository('ERPAdminBundle:EncabezadoOrden')->findById($idEmcabezado);
              for($i=0;$i<$dimensionEN;$i++){
              $productoIdEN= $this->getDoctrine()->getRepository('ERPAdminBundle:BeardProducto')->findById($productosEN[$i]); 
            
              
              
              $objeto3 = new Orden();
              $objeto3->setEncabezadoOrden($EncabezadoN[0]);
              $objeto3->setCantidad($cantidadesEN[$i]);
              $objeto3->setPrecio($preciosEN[$i]);
              $objeto3->setIdProducto($productosEN[$i]);
              $objeto3->setDescuento($descuentosEN[$i]);
              $objeto3->setProductoId($productoIdEN[0]);
              $em->persist($objeto3);
               $em->flush();
            }
            

            
  
            $data['estado']=true;


            return new Response(json_encode($data)); 
            
            
         }
        
        
        
    } 
    
    
    
     /**
     * 
     *
     * @Route("/registro/compra/entregado/data", name="registro_compra_entregado_data")
     */
    public function RegistroEntragadoCompraAction(Request $request)
    {
        
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        $entity = new EncabezadoOrden();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered']= count($territoriosTotal);
        
        $territorio['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        
        
        $ordenamientoVariable = $request->query->get('order');
        

        $columna = $ordenamientoVariable[0]['column'];
        $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
        
        if ($columna=='0'){
            
            $x="id";
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else if ($columna=='1'){
            $x='numeroOrden';
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else  if ($columna=='2'){
            
           $orden=" cli.nombre ".$tipoOrdenamiento;

            
        }else{
              $x='monto';
                $orden="enc.".$x." ".$tipoOrdenamiento;
        }
        
         if($busqueda['value']!=''){
        
                    $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta, enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                        . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=1 AND enc.permiso =1 "
                     . "ORDER BY ".$orden;
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                        $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                         . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=1 AND enc.permiso =1 "
                    . "ORDER BY ".$orden;
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
                   
                       $territorio['recordsFiltered']= count($territorio['data']);
       
        }
        else{
             $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli WHERE  enc.estado=1 AND enc.permiso =1 "
                       . "ORDER BY ".$orden;
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
            
                $territorio['recordsFiltered']= count($territorio['data']);
        }
       


     
        
        
     
        
        return new Response(json_encode($territorio));
    }
    
    
    
    
      
   /**
     * 
     *
     * @Route("/registro/compra/pendientes/data", name="registro_compra_pendientes_data")
     */
    public function RegistroPendientesCompraAction(Request $request)
    {
        
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        $entity = new EncabezadoOrden();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered']= count($territoriosTotal);
        
        $territorio['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        
        $ordenamientoVariable = $request->query->get('order');
        

        $columna = $ordenamientoVariable[0]['column'];
        $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
        
        if ($columna=='0'){
            
            $x="id";
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else if ($columna=='1'){
            $x='numeroOrden';
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else  if ($columna=='2'){
            
           $orden=" cli.nombre ".$tipoOrdenamiento;

            
        }else{
              $x='monto';
                $orden="enc.".$x." ".$tipoOrdenamiento;
        }
        

         if($busqueda['value']!=''){
        
                    $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                        . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=2 AND enc.permiso =1 "
                            . "ORDER BY ".$orden;
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                        $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                         . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=2 AND enc.permiso =1 "
                            . "ORDER BY ".$orden;
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
                       $territorio['recordsFiltered']= count($territorio['data']);
        }
        else{
             $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli WHERE  enc.estado=2 AND enc.permiso =1 "
                        . "ORDER BY ".$orden;
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
                $territorio['recordsFiltered']= count($territorio['data']);
        }
       


     
        
        
     
        
        return new Response(json_encode($territorio));
    }
    
    
    
   /**
     * 
     *
     * @Route("/registro/compra/enviados/data", name="registro_compra_enviados_data")
     */
    public function RegistroEnviadosCompraAction(Request $request)
    {
        
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        $entity = new EncabezadoOrden();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered']= count($territoriosTotal);
        
        $territorio['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        
         $ordenamientoVariable = $request->query->get('order');
        

        $columna = $ordenamientoVariable[0]['column'];
        $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
        
        if ($columna=='0'){
            
            $x="id";
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else if ($columna=='1'){
            $x='numeroOrden';
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else  if ($columna=='2'){
            
           $orden=" cli.nombre ".$tipoOrdenamiento;

            
        }else{
              $x='monto';
                $orden="enc.".$x." ".$tipoOrdenamiento;
        }
        
        
        
         if($busqueda['value']!=''){
        
                    $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                        . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=4 AND enc.permiso =1 "
                        . "ORDER BY ".$orden;
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                        $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                         . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=4 AND enc.permiso =1 "
                         . "ORDER BY ".$orden;
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
                       $territorio['recordsFiltered']= count($territorio['data']);
       
        }
        else{
             $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli WHERE  enc.estado=4 AND enc.permiso =1 "
                           . "ORDER BY ".$orden;
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
                $territorio['recordsFiltered']= count($territorio['data']);
        }
       


     
        
        
     
        
        return new Response(json_encode($territorio));
    }
    
     /**
     *
     * @Route("/clientes/registrocompras/clientes", name="clientes_registros_compras_clientes",options={"expose"=true})
     * @Method("GET")
     */
    public function RegistroComprasClientesAction(Request $request)
    {
   

        return $this->render('ERPCRMBundle:historialcliente/indexRegistroComprasCliente.html.twig', array(
     
        ));
    }
    
    
    //Metyodo que llama los datos del estado completo en un registro de venta
      /**
     * 
     *
     * @Route("/registro/compra/completo/data", name="registro_compra_completo_data")
     */
    public function RegistroCompletoCompraAction(Request $request)
    {
        
        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        
        $entity = new EncabezadoOrden();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:EncabezadoOrden')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($territoriosTotal);
        $territorio['recordsFiltered']= count($territoriosTotal);
        
        $territorio['data']= array();
        //var_dump($busqueda);
        //die();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        
        //echo count($arrayFiltro);
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
        
        $ordenamientoVariable = $request->query->get('order');
        
        $columna = $ordenamientoVariable[0]['column'];
        $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
        
        if ($columna=='0'){
            
            $x="id";
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else if ($columna=='1'){
            $x='numeroOrden';
              $orden="enc.".$x." ".$tipoOrdenamiento;
            
        }else  if ($columna=='2'){
            
           $orden=" cli.nombre ".$tipoOrdenamiento;

            
        }else{
              $x='monto';
                $orden="enc.".$x." ".$tipoOrdenamiento;
        }
        
        
        
        
        
         if($busqueda['value']!=''){
        
                    $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                        . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=5 AND enc.permiso =1 "
                           . "ORDER BY ".$orden;
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                        $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                         . "WHERE upper(cli.nombre)  LIKE upper(:busqueda) AND enc.estado=5 AND enc.permiso =1 "
                            . "ORDER BY ".$orden;
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
           $territorio['recordsFiltered']= count($territorio['data']);
        }
        else{
             $dql = "SELECT enc.numeroOrden, enc.id as id,enc.tipoVenta as tipoVenta,enc.monto as monto,enc.tipoPago as pago , cli.nombre as nombreCompleto, cli.direccion as datosCliente FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli WHERE  enc.estado=5 AND enc.permiso =1 "
                            . "ORDER BY ".$orden;
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
                $territorio['recordsFiltered']= count($territorio['data']);
        }
       


     
        
        
     
        
        return new Response(json_encode($territorio));
    }
   
    
//    Metodo del controlador que elimina los registros de venta
    
    
     /**
     * @Route("/eliminarOrdenDeVenta/", name="eliminarOrdenDeVenta", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function EliminarRegistroDeVentaAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
             $id = $request->get('id'); 
            $objeto = $this->getDoctrine()->getRepository('ERPAdminBundle:EncabezadoOrden')->findById($id);
            $objeto[0]->setPermiso(0);
            $em->merge($objeto[0]);
            $em->flush();
            $data['estado']=true;
            
                
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
    
  
    
    
    
    
    
    
 
    
    
}
