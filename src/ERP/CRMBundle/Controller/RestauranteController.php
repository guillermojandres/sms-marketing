<?php

namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception;
use ERP\AdminBundle\Entity\Restaurante;


/**
 * ClientePotencial controller.
 *
 * @Route("admin/negocios")
 */
class RestauranteController extends Controller
{
    /**
     * Lists all Restaurantes entities.
     *
     * @Route("/", name="restaurantes_dashboard",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        
        return $this->render('ERPCRMBundle:restaurantes/dashboardRestaurantes.html.twig', array(
            
        ));
    }
    
    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/lista", name="listaRestaurantes",options={"expose"=true})
     * @Method("GET")
     */
    public function ListaRestauranteAction()
    {
        
        return $this->render('ERPCRMBundle:restaurantes/index.html.twig', array(
            
        ));
    }

    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/nuevo/", name="nuevo_restaurante",options={"expose"=true})
     * @Method("GET")
     */
    public function CallNewRestaurantAction()
    {
        
        return $this->render('ERPCRMBundle:restaurantes/nuevo.html.twig', array(
            
        ));
    }


    /**
     * 
     *
     * @Route("/restaurante/data", name="restaurante_data",options={"expose"=true})
     */
    public function RestauranteDataAction(Request $request)
    {
        
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Easy set variables
     */
    
    /* Array of database columns which should be read and sent back to DataTables. Use a space where
     * you want to insert a non-database field (for example a counter or static image)
     */
        $entity = new Restaurante();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getManager();
        $restaurante = $em->getRepository('ERPAdminBundle:Restaurante')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($restaurante);
        $territorio['recordsFiltered']= count($restaurante);
        
        $territorio['data']= array();
        $arrayFiltro = explode(' ',$busqueda['value']);
        
        $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);

        
        //SQL Nativo
        
        $ordenamientoVariable = $request->query->get('order');
        
        $columna = $ordenamientoVariable[0]['column'];
        $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
        
        if ($columna=='0'){
            
            $x="id";
            
            
        }else if ($columna=='1'){
            $x='direccion';
            
            
        }else  if ($columna=='2'){
            
            $x='nombre';
        
            
        }
        
        

        if($busqueda['value']!=''){
          $value = $busqueda['value'];  
           
          $sql = "SELECT .id as id, rs.nombre as nombre,rs.telefono as telefono, rs.nombre_contacto as contacto FROM restaurante rs "
                    . "WHERE (upper(rs.nombre)  LIKE '%".strtoupper($value)."%' OR rs.telefono LIKE '%".strtoupper($value)."%') AND rs.estado=1 "
                    . "ORDER BY rs.".$x." ".$tipoOrdenamiento;
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $territorio['data'] = $stmt->fetchAll();
             $territorio['recordsFiltered']= count($territorio['data']);
                 
       
        }
        else{
                 $sql = "SELECT rs.id as id, rs.nombre as nombre,rs.telefono as telefono, rs.nombre_contacto as contacto, rs.numero_twillio as telefonoT, rs.correo as correo FROM restaurante rs WHERE rs.estado=1 "
                    . "ORDER BY rs.nombre ".$tipoOrdenamiento;
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $territorio['data'] = $stmt->fetchAll();
             $territorio['recordsFiltered']= count($territorio['data']);



        }
     
        
        return new Response(json_encode($territorio));
    }

      /**
     * SET NEW Restaurante entities.
     *
     * @Route("/insertar/", name="insertar_restaurante",options={"expose"=true})
     * @Method("POST")
     */
    public function NewRestaurantAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            
            $nombre = $request->get('nombre');
            $direccion = $request->get('direccion');
            $telefono = $request->get('telefono');
            $correoElectronico = $request->get('correoElectronico');
            $contactoR = $request->get('contactoR');
            $numeroTwillio = $request->get('numeroTwillio');

            $em = $this->getDoctrine()->getManager();
            $obj = new Restaurante();
            $obj->setNombre($nombre);
            $obj->setDireccion($direccion);
            $obj->setTelefono($telefono);
            $obj->setCorreo($correoElectronico);
            $obj->setNombreContacto($contactoR);
            $obj->setEstado(1);
            $obj->setFechaInsercion(new \DateTime());
            $obj->setFechaModificacion(new \DateTime());
            $obj->setNumeroTwillio($numeroTwillio);
            $em->persist($obj);
            $em->flush();
            $data['estado']=true;




            return new Response(json_encode($data)); 
            
         }
        
        
    }

    /**
     * @Route("/{id}", name="editar_restaurante", options={"expose"=true})
     * @Method("GET")
     */
    public function CallEditarRestauranteAction($id)
    {
        
      
        
        $em = $this->getDoctrine()->getManager();
        $restaurante = $em->getRepository('ERPAdminBundle:Restaurante')->findById($id);
     
        // var_dump($restaurante);
        // die();
        return $this->render('ERPCRMBundle:restaurantes/editar.html.twig', array(
            'restaurante' => $restaurante,
        ));
    }
    
    /**
     * Displays a form to edit an existing Orden entity.
     *
     * @Route("/restaurante/eliminarRestaurante", name="eliminar_restaurante",options={"expose"=true})
     */
    public function EliminarRestauranteAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        
            $idEliminar = $this->get('request')->request->get('idEliminar');
     
           
                $em = $this->getDoctrine()->getManager();
                $obj = $em->getRepository('ERPAdminBundle:Restaurante')->find($idEliminar);    
                $obj->setEstado(0);
                $em->persist($obj);
                $em->flush();

            
       $data['estado']=true;
       return new Response(json_encode($data)); 
        
        
        
    }


         /**
     * SET NEW Restaurante entities.
     *
     * @Route("/editarRestaurante/edicion", name="editar_restaurante_action",options={"expose"=true})
     * @Method("POST")
     */
    public function EditarRestauranteAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('idRestaurante');
            $nombre = $request->get('nombre');
            $direccion = $request->get('direccion');
            $telefono = $request->get('telefono');
            $correoElectronico = $request->get('correoElectronico');
            $contactoR = $request->get('contactoR');
            $numeroTwillio = $request->get('numeroTwillio');
            $obj = $em->getRepository('ERPAdminBundle:Restaurante')->findById($id);
            $obj[0]->setNombre($nombre);
            $obj[0]->setDireccion($direccion);
            $obj[0]->setTelefono($telefono);
            $obj[0]->setCorreo($correoElectronico);
            $obj[0]->setNombreContacto($contactoR);
            $obj[0]->setNumeroTwillio($numeroTwillio);
            $obj[0]->setFechaModificacion(new \DateTime());

            $em->merge($obj[0]);
            $em->flush();
            $data['estado']=true;

            return new Response(json_encode($data)); 
            
         }
        
        
    }
    
    
    
 }
