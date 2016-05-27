<?php

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
     * @Route("/clientepotencial/data", name="cliente_data")
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
    * Ajax utilizado para buscar el precio del atributo seleccionado
    *  
    * @Route("/attributes/insert/clientepotencial", name="insert_cliente")
    */
    public function insertarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
//            var_dump($data);
//            die();
            
           $entity = new CrmCliente();
           $entity->setNombreCompleto($data[0]);
           $entity->setSitioWeb($data[1]);
           $entity->setDatosCliente($data[2]); 
           $entity->setPorcentaje($data[3]);
           
         
          
          
          $id_categoriaCliente = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->find($data[4]);
          
          
         
           if ($data[4] != "") {
                $id_clientepot = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($data[5]);
            } else {

                $id_clientepot = null;
            }

            if ($data[5] != "") {
                $id_territorio = $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($data[6]);
            } else {
                $id_territorio = null;
            }
            
            
            
            $var = "";
            if ($data[7] == 0) {
                $var = "Individual";
            } else {
                $var = "Compañia";
            }
            
             $credito = "";
            if ($data[8] == 0) {
                $credito =0;
            } elseif($data[8]==1) {
                $credito =1 ;
            } else {
                $credito =null ;
            }
            
            
            
            $entity->setCategoriaCliente($id_categoriaCliente);
            $entity->setClientePotencial($id_clientepot);
            $entity->setTerritorio($id_territorio);
            
            $entity->setTipo($var);
            $entity->setCredito($credito);
            $entity->setEstado(1);
            
            $em->persist($entity);
            $em->flush();
                $response->setData(array(
                           'flag'       => 1
                    )); 
                return $response;

            
        } 
        else {    
            
            $response->setData(array(
                           'flag'       => $mensaje
                    ));  
            return $response; 
        }  
    }  
    
  /**
    * Ajax utilizado para buscar el precio del atributo seleccionado
    *  
    * @Route("/attributes/edit/cliente", name="edit_cliente")
    */
    public function editarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
       
            $entity = $em->getRepository('ERPAdminBundle:CrmCliente')->find($data[0]);
             $entity->setNombreCompleto($data[1]);
            $entity->setSitioWeb($data[2]);
           $entity->setDatosCliente($data[3]); 
           $entity->setPorcentaje($data[4]);
          $id_categoriaCliente = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->find($data[5]);
          
          
          
           if ($data[6] != "") {
                $id_clientepot = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($data[6]);
            } else {

                $id_clientepot = null;
            }

            if ($data[7] != "") {
                $id_territorio = $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($data[7]);
            } else {
                $id_territorio = null;
            }
            
            
            
            $var = "";
            if ($data[8] == 0) {
                $var = "Individual";
            } else {
                $var = "Compañia";
            }
            
//            var_dump($data);
//            die();
            
             $credito = "";
            if ($data[9] == 0) {
                $credito =0;
            } elseif($data[9]==1) {
                $credito =1 ;
            } else {
                $credito =null ;
            }
            
            
            
            $entity->setCategoriaCliente($id_categoriaCliente);
            $entity->setClientePotencial($id_clientepot);
            $entity->setTerritorio($id_territorio);
            
            $entity->setTipo($var);
            $entity->setCredito($credito);
            $entity->setEstado(1);
            $em->merge($entity);
            $em->flush();
            $response->setData(array(
                           'flag'       => 1
                    )); 

                
                
        } else {    
            
            $response->setData(array(
                           'flag'       => $mensaje
                    ));  
            
        }  
        return $response; 
    }
    
    

/**
     * Displays a form to edit an existing Orden entity.
     *
     * @Route("/admin/orders/delete/deletedetalle", name="delete_cliente")
     */
    public function deleteClienteAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        
            $idcliente = $this->get('request')->request->get('idcliente');
            
            foreach($idcliente as $row){
                $em = $this->getDoctrine()->getManager();
                $cliente = $em->getRepository('ERPAdminBundle:CrmCliente')->find($row);
                $cliente->setEstado(0);
                $em->persist($cliente);
                $em->flush();
                
            }
   
            $response->setData(array(
                            'flag' => 0,
                            
                    ));    
            return $response; 
       
        
        
        
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
        
                    $dql = "SELECT cli.id , cli.nombreCompleto as nombreCompleto, cli.porcentaje as porcentaje,cli.credito as credito, concat(concat('<input type=\"checkbox\" class=\"checkbox idcliente\" id=\"',cli.id), '\">' as link FROM ERPAdminBundle:CrmCliente cli "
                        . "JOIN cli.categoriaCliente cat "
                        . "WHERE cli.categoriaCliente=10  AND cli.estado=1 "
                        . "ORDER BY cli.nombreCompleto DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                    $dql = "SELECT cli.id , cli.nombreCompleto as nombreCompleto, cli.porcentaje as porcentaje,cli.credito as credito, concat(concat('<input type=\"checkbox\" class=\"checkbox idcliente\" id=\"',cli.id), '\">' as link FROM ERPAdminBundle:CrmCliente cli "
                        . "JOIN cli.categoriaCliente cat "
                        . "WHERE cli.categoriaCliente=10  AND cli.estado=1 "
                        . "ORDER BY cli.nombreCompleto DESC ";
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT cli.id , cli.nombreCompleto as nombreCompleto, cli.porcentaje as porcentaje,cli.credito as credito, concat(concat('<input type=\"checkbox\" class=\"checkbox idcliente\" id=\"',cli.id), '\">' as link FROM ERPAdminBundle:CrmCliente cli "
                   . "WHERE  cli.categoriaCliente=10  AND cli.estado=1 "
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
            
            
            $dqlPer = "SELECT cli.nombreCompleto AS nombre FROM ERPAdminBundle:CrmCliente cli WHERE"
                   . " cli.id= :id ";

            $resultadoPersona = $em->createQuery($dqlPer)
                        ->setParameters(array('id'=>$id))
                        ->getResult();
            
              
            
            $rp=$resultadoPersona[0]['nombre'];
                 $data['estado']=true;
                 $data['nombre']=$rp;
            
            
                
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
            
            
            $dqlPer = "SELECT pro.precio AS precio FROM ERPAdminBundle:BeardProducto pro WHERE"
                   . " pro.id= :id ";

            $resultadoPersona = $em->createQuery($dqlPer)
                        ->setParameters(array('id'=>$idProducto))
                        ->getResult();
            
          
            
            $rp=$resultadoPersona[0]['precio'];
        
                 $data['estado']=true;
                 $data['precio']=$rp;
            
            
                
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
            $dimension = count($productos);
 
           $cliente= $this->getDoctrine()->getRepository('ERPAdminBundle:CrmCliente')->findById($idCliente); 
            
           $objeto = new EncabezadoOrden();
           $objeto->setCrmCliente($cliente[0]);
           $objeto->setMonto($totalRC);
           $objeto->setTipoPago($tipoPago);
           $objeto->setEstado($estado);
           $objeto->setFechaRegistro(new \DateTime($fechaRC));
           
           
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
        
         if($busqueda['value']!=''){
        
                    $dql = "SELECT enc.id,enc.monto as monto,enc.estado as estado,enc.tipoPago as pago , cli.nombreCompleto as nombreCompleto, cli.datosCliente as datosCliente, concat(concat('<input type=\"checkbox\" class=\"checkbox idEncabezado\" id=\"',enc.id), '\">' as link FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                        . "WHERE upper(cli.nombreCompleto)  LIKE upper(:busqueda) "
                        . "ORDER BY enc.fechaRegistro ASC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                        $dql = "SELECT enc.id,enc.monto as monto,enc.estado as estado,enc.tipoPago as pago , cli.nombreCompleto as nombreCompleto, cli.datosCliente as datosCliente, concat(concat('<input type=\"checkbox\" class=\"checkbox idEncabezado\" id=\"',enc.id), '\">' as link FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                         . "WHERE upper(cli.nombreCompleto)  LIKE upper(:busqueda) "
                        . "ORDER BY enc.fechaRegistro ASC ";
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
             $dql = "SELECT enc.id,enc.monto as monto,enc.estado as estado,enc.tipoPago as pago , cli.nombreCompleto as nombreCompleto, cli.datosCliente as datosCliente, concat(concat('<input type=\"checkbox\" class=\"checkbox idEncabezado\" id=\"',enc.id), '\">' as link FROM ERPAdminBundle:EncabezadoOrden enc "
                        . "JOIN enc.crmClienteId cli "
                        . "ORDER BY enc.fechaRegistro DESC ";
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
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
            
              
             $dqlEncabezado = "SELECT date_format(enc.fechaRegistro,'%y%m%d') as fechaRegistro,enc.estado,enc.tipoPago, enc.monto, cli.nombreCompleto FROM ERPAdminBundle:EncabezadoOrden enc "
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
            $subtoalRes = $cantidad*$precio;
            $nuevoTotal = $montoActual-$subtoalRes;
            
            
           $objE->setMonto($nuevoTotal);
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
    
            
           $objeto = $this->getDoctrine()->getRepository('ERPAdminBundle:EncabezadoOrden')->findById($idEmcabezado);
           $objeto[0]->setMonto($totalRC);
           $objeto[0]->setTipoPago($tipoPago);
           $objeto[0]->setEstado($estado);
           $objeto[0]->setFechaRegistro(new \DateTime($fechaRC));
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
    
    
    
   
  
    
    
    
}
