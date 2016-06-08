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

/**
 * Cliente controller.
 *
 * @Route("admin/cliente")
 */
class ClienteController extends Controller
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
     * Lists all ClientePotencial entities.
     *
     * @Route("/nuevocliente", name="nuevocliente",options={"expose"=true})
     * @Method("GET")
     */
    public function NuevoClientePotencialAction()
    {
        
        return $this->render('ERPCRMBundle:clientes/nuevo.html.twig', array(
            
        ));
    }
 
    /**
     * @Route("/admin/{id}", name="editarClientes", options={"expose"=true})
     * @Method("GET")
     */
    public function EditarClientePotencialAction($id)
    {
        
      
        
        $em = $this->getDoctrine()->getManager();
        $cliente = $em->getRepository('ERPAdminBundle:Cliente')->findById($id);
     
        
        return $this->render('ERPCRMBundle:clientes/editar.html.twig', array(
            'cliente' => $cliente,
        ));
    }
    

   
   /**
     * 
     *
     * @Route("/cliente/data", name="cliente_data")
     */
    public function DataClientePotencialAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
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
        
        //SQL Nativo
       
        

        if($busqueda['value']!=''){
          $value = $busqueda['value'];  
           
          $sql = "SELECT cp.id as id,cp.codigo as codigo, cp.nombre as nombre,cp.telefono as telefono, contac.nombre as contacto FROM cliente cp"
                    . " LEFT OUTER JOIN contacto contac on cp.contacto_id=contac.id "
                    . "WHERE (upper(cp.nombre)  LIKE '%".strtoupper($value)."%' OR cp.codigo LIKE '%".strtoupper($value)."%') AND cp.estado=1 "
                    . "ORDER BY cp.nombre ASC";
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $territorio['data'] = $stmt->fetchAll();
                 
       
        }
        else{
              $sql = "SELECT cp.id as id,cp.codigo as codigo, cp.nombre as nombre,cp.telefono as telefono, contac.nombre as contacto FROM cliente cp"
                    . " LEFT OUTER JOIN contacto contac on cp.contacto_id=contac.id "
                    . "WHERE cp.estado=1 "
                    . "ORDER BY cp.nombre ASC";
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $territorio['data'] = $stmt->fetchAll();



        }
     
        
        return new Response(json_encode($territorio));
    }
    
    
    /**
     * @Route("/insertarcliente/", name="insertarcliente", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function InsertarClienteAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
             
            $em = $this->getDoctrine()->getManager();
            
            $credito = $request->get('credito'); 
            $categoria = $request->get('categoria'); 
            $nombre = $request->get('nombre'); 
            $direccion = $request->get('direccion'); 
            $telefono = $request->get('telefono'); 
            $telefonoM = $request->get('telefonoM'); 
            $nrc = $request->get('nrc'); 
            $nit = $request->get('nit'); 
            $correoElectronico = $request->get('correoElectronico');
            $paginaWeb = $request->get('paginaWeb');
            $descripcion = $request->get('descripcion');

            $referidoPor = $request->get('referidoPor');
            $contactoId = $request->get('contactoId');
            $codigo = $this->generarCorrelativoCliente();
        
             $objeto = new Cliente();
             if ($contactoId !=""){
                  $idContacto = $this->getDoctrine()->getRepository('ERPAdminBundle:Contacto')->findById($contactoId);
                  $objeto->setContactoId($idContacto[0]);
             }else{
                 $objeto->setContactoId(null);
             }
            $objeto->setCodigo($codigo);
            $objeto->setNombre($nombre);
            $objeto->setDireccion($direccion);
            $objeto->setTelefono($telefono);
            $objeto->setMovil($telefonoM);
            $objeto->setNrc($nrc);
            $objeto->setNit($nit);
            $objeto->setCorreoelectronico($correoElectronico);
            $objeto->setPaginaWeb($paginaWeb);
            $objeto->setReferidoPor($referidoPor);
            $objeto->setDescripcion($descripcion);
            $objeto->setEstado(1);
            $objeto->setCategoria($categoria);
            $objeto->setCredito($credito);
            $em->persist($objeto);
            $em->flush();
            $data['estado']=true;
                       
            
            
            
            
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
   /**
     * @Route("/editarcliente/", name="editarcliente", options={"expose"=true})
     * @Method("POST")
     */
    
    
      public function EditarClienteAction(Request $request) {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();

         if($isAjax){
            
             $id= $request->get('idCliente');
           
             $em = $this->getDoctrine()->getManager();
             
            $objeto = $em->getRepository('ERPAdminBundle:Cliente')->findById($id);
            
            $credito = $request->get('credito'); 
            $categoria = $request->get('categoria'); 
            $nombre = $request->get('nombre');
            $direccion = $request->get('direccion'); 
            $telefono = $request->get('telefono'); 
            $telefonoM = $request->get('telefonoM'); 
            $nrc = $request->get('nrc'); 
            $nit = $request->get('nit'); 
            $correoElectronico = $request->get('correoElectronico');
            $paginaWeb = $request->get('paginaWeb');
            $descripcion = $request->get('descripcion');
        
            $referidoPor = $request->get('referidoPor'); 
            $contactoId = $request->get('contactoId');
            
        
              if ($contactoId !=""){
                  $idContacto = $this->getDoctrine()->getRepository('ERPAdminBundle:Contacto')->findById($contactoId);
               
                  $objeto[0]->setContactoId($idContacto[0]);
             }else{
                 $objeto[0]->setContactoId(null);
             }
            
            $objeto[0]->setNombre($nombre);
            $objeto[0]->setDireccion($direccion);
            $objeto[0]->setTelefono($telefono);
            $objeto[0]->setMovil($telefonoM);
            $objeto[0]->setNrc($nrc);
            $objeto[0]->setNit($nit);
            $objeto[0]->setCorreoelectronico($correoElectronico);
            $objeto[0]->setPaginaWeb($paginaWeb);
            $objeto[0]->setReferidoPor($referidoPor);
            $objeto[0]->setDescripcion($descripcion);
            $objeto[0]->setCategoria($categoria);
            $objeto[0]->setCredito($credito);
            $em->merge($objeto[0]);
            $em->flush();
            
            $data['estado']=true;
                       
            
            
            
            
             return new Response(json_encode($data)); 
            
            
         }
        
        
        
    }
    
 /**
     * Displays a form to edit an existing Orden entity.
     *
     * @Route("/admin/eliminarcliente", name="eliminarcliente")
     */
    public function EliminarClienteAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        
            $idcliente = $this->get('request')->request->get('idcliente');
     
            foreach($idcliente as $row){
                $em = $this->getDoctrine()->getManager();
                $cliente = $em->getRepository('ERPAdminBundle:Cliente')->find($row);    
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
    * Ajax utilizado para buscar informacion de contactos
    * 
    * @Route("/buscarContacto", name="buscarContacto",options={"expose"=true})
    */
    public function BuscarContactoAction(Request $request)
    {
        $busqueda = $request->query->get('q');
        $page = $request->query->get('page');
       
        $em = $this->getDoctrine()->getEntityManager();
        $dql = "SELECT abo.id abogadoid, abo.nombre  "
                        . "FROM ERPAdminBundle:Contacto abo "
                        . "WHERE upper(abo.nombre) LIKE upper(:busqueda)"
                        . " AND abo.estado=1 "
                        . "ORDER BY abo.nombre ASC ";
       
        $abogado['data'] = $em->createQuery($dql)
                ->setParameters(array('busqueda'=>"%".$busqueda."%"))
                ->setMaxResults( 10 )
                ->getResult();
       
        return new Response(json_encode($abogado));
    }
    
    
    
     public function generarCorrelativoCliente(){
    
       
        $em = $this->getDoctrine()->getManager();
        $dqlNumerocorrelativo = "SELECT COUNT(u.id) as numero FROM ERPAdminBundle:Cliente u"
                . " WHERE u.codigo like '%BA%' ";
        $resultCorrelativo = $em->createQuery($dqlNumerocorrelativo)->getArrayResult();
        $numero_base = $resultCorrelativo[0]['numero'];
        
        
       $primerLetras="BA"; 
       $valor ="";
        
       $numero = $numero_base+1;
        switch (strlen($numero_base)){
            case 1:
                $valor=$primerLetras.="0000".$numero;
            break;
            case 2:    
                $valor=$primerLetras.="000".$numero;
            break;
            case 3:    
                 $valor=$primerLetras.="00".$numero;
            break;
            case 4:    
                $valor=$primerLetras.="0".$numero;
            break;
            case 5:    
                  $valor=$primerLetras.=$numero;
            break;
            
              
            
        }
        return $valor;
     }
     
    

    
    
}
