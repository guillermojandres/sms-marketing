<?php

namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception;
use ERP\AdminBundle\Entity\Mensaje;


/**
 * ClientePotencial controller.
 *
 * @Route("admin/mensajes")
 */
class MensajesController extends Controller
{
    /**
     * Lists all menntificadores entities.
     *
     * @Route("/", name="mensajes_dashboard",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        
        return $this->render('ERPCRMBundle:mensajes/dashboardMensajes.html.twig', array(
            
        ));
    }
    
    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/listaMensajes", name="listaMensajes",options={"expose"=true})
     * @Method("GET")
     */
    public function ListaMensajesAction()
    {
        
        return $this->render('ERPCRMBundle:mensajes/index.html.twig', array(
            
        ));
    }

    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/nuevo/", name="nuevo_mensaje",options={"expose"=true})
     * @Method("GET")
     */
    public function CallNewMensajeAction()
    {
        
        return $this->render('ERPCRMBundle:mensajes/nuevo.html.twig', array(
            
        ));
    }
  

    /**
     * 
     *
     * @Route("/mensajes/lista/", name="mensajes_data_all",options={"expose"=true})
     */
    public function MensajesDataAction(Request $request)
    {
        
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Easy set variables
     */
    
    /* Array of database columns which should be read and sent back to DataTables. Use a space where
     * you want to insert a non-database field (for example a counter or static image)
     */
        $entity = new Mensaje();
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getManager();
        $menntificador = $em->getRepository('ERPAdminBundle:Mensaje')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($menntificador);
        $territorio['recordsFiltered']= count($menntificador);
        
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
            $x='titulo';
            
            
        }else  if ($columna=='2'){
            
            $x='texto';
        
            
        }
        
        if($busqueda['value']!=''){
          $value = $busqueda['value'];  
           
          $sql = "SELECT men.id as id, men.titulo as titulo, rs.nombre as restaurante, men.fecha_envio as fechaEnvio,men.hora_envio as horaEnvio, 
        CASE 
                     WHEN men.estado_envio='0' THEN 'Aun no enviado'
                     WHEN men.estado_envio='1' THEN 'Enviado'
                     WHEN men.estado_envio='2' THEN 'Cancelado'
        END as estadoEnvio 
            FROM mensaje men LEFT OUTER JOIN restaurante rs  ON men.id = rs.id  
             WHERE (upper(men.titulo)  LIKE '%".strtoupper($value)."%' OR rs.nombre LIKE '%".strtoupper($value)."%') AND men.estado=1 "
                    . "ORDER BY men.".$x." ".$tipoOrdenamiento;
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $territorio['data'] = $stmt->fetchAll();
             $territorio['recordsFiltered']= count($territorio['data']);
                 
       
        }
        else{
        $sql = "SELECT men.id as id, men.titulo as titulo, rs.nombre as restaurante, men.fecha_envio as fechaEnvio,men.hora_envio as horaEnvio, 
        CASE 
                     WHEN men.estado_envio='0' THEN 'Aun no enviado'
                     WHEN men.estado_envio='1' THEN 'Enviado'
                     WHEN men.estado_envio='2' THEN 'Cancelado'
        END as estadoEnvio 
            FROM mensaje men LEFT OUTER JOIN restaurante rs  ON men.restaurante_id = rs.id  
             WHERE men.estado=1 ORDER BY men.titulo ".$tipoOrdenamiento;
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $territorio['data'] = $stmt->fetchAll();
            $territorio['recordsFiltered']= count($territorio['data']);


        }
     
        
        return new Response(json_encode($territorio));
    }

    /**
     * Insertar indentificador entities.
     *
     * @Route("/insertarMensaje/", name="insertar_mensaje",options={"expose"=true})
     * @Method("POST")
     */
    public function NewMensajeAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            
            $idRestaurante = $request->get('idRestaurante');
            $titulo = $request->get('titulo');
            $texto = $request->get('texto');
            $horaEnvio = $request->get('horaEnvio');
            $fechaEnvio = $request->get('fechaEnvio');
            $obj = new Mensaje();
        

            $restaurante = $this->getDoctrine()->getRepository('ERPAdminBundle:Restaurante')->findById($idRestaurante);
                  $obj->setRestauranteId($restaurante[0]);

            $horaEnvio= explode(":", $horaEnvio);
            $horaEnvioN=$horaEnvio[0].":".$horaEnvio[1].":00";
            $obj->setTitulo($titulo);
            $obj->setTexto($texto);
            $obj->setHoraEnvio(new \DateTime($horaEnvioN));
            $obj->setFechaEnvio(new \DateTime($fechaEnvio));
            $obj->setFechaModificacion(new \DateTime());
            $obj->setFechaInsercion(new \DateTime($fechaEnvio));
            $obj->setEstado(1);
            $obj->setEstadoEnvio(0);
            $em->persist($obj);
            $em->flush();
            $data['estado']=true;

            return new Response(json_encode($data)); 
            
         }
        
        
    }

    /**
     * @Route("/{id}", name="editar_mensaje", options={"expose"=true})
     * @Method("GET")
     */
    public function CallEditarMensajeAction($id)
    {
        
      
        
        $em = $this->getDoctrine()->getManager();
        $mensajes = $em->getRepository('ERPAdminBundle:Mensaje')->findById($id);
        // var_dump($mensajes);
        // die();
        return $this->render('ERPCRMBundle:mensajes/editar.html.twig', array(
            'mensaje' => $mensajes,
        ));
    }
    
    /**
     * Displays a form to edit an existing Orden entity.
     *
     * @Route("/mensajes/eliminarMensaje", name="eliminar_mensaje",options={"expose"=true})
     */
    public function EliminarMenasajeAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        
            $idMensaje = $this->get('request')->request->get('idEliminar');
     
           
                $em = $this->getDoctrine()->getManager();
                $obj = $em->getRepository('ERPAdminBundle:Mensaje')->find($idMensaje);    
                $obj->setEstado(0);
                $obj->setFechaModificacion(new \DateTime());
                $obj->setEstadoEnvio(2);
                $em->persist($obj);
                $em->flush();

            
       $data['estado']=true;
       return new Response(json_encode($data)); 
        
        
        
    }


     /**
     * SET Edicion de mensajes entities.
     *
     * @Route("/editarMensajes/edicion", name="editar_mensaje_action",options={"expose"=true})
     * @Method("POST")
     */
    public function EditarMensajesAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       $em = $this->getDoctrine()->getManager();
        if($isAjax){
            
            $idMensaje =$request->get('idMensajes');
            $idRestaurante = $request->get('idRestaurante');
            $titulo = $request->get('titulo');
            $texto = $request->get('texto');
            $horaEnvio = $request->get('horaEnvio');
            $fechaEnvio = $request->get('fechaEnvio');

            $horaEnvio= explode(":", $horaEnvio);
            $horaEnvioN=$horaEnvio[0].":".$horaEnvio[1].":00";

            $obj = $em->getRepository('ERPAdminBundle:Mensaje')->findById($idMensaje);

            $restaurante = $this->getDoctrine()->getRepository('ERPAdminBundle:Restaurante')->findById($idRestaurante);
            $obj[0]->setRestauranteId($restaurante[0]);
            $obj[0]->setTitulo($titulo);
            $obj[0]->setTexto($texto);
            $obj[0]->setHoraEnvio(new \DateTime($horaEnvioN));
            $obj[0]->setFechaEnvio(new \DateTime($fechaEnvio));
            $obj[0]->setFechaModificacion(new \DateTime());
            $obj[0]->setEstado(1);
            $em->merge($obj[0]);
            $em->flush();
            $data['estado']=true;

            return new Response(json_encode($data)); 
            
         }
        
        
    }



    /**
     * Insertar indentificador entities.
     *
     * @Route("/insertarMensajeAndEnviarMensaje/", name="insertar_and_enviar_mensaje",options={"expose"=true})
     * @Method("POST")
     */
    public function NewSendAndCreateMensajeAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            
            $idRestaurante = $request->get('idRestaurante');
            $titulo = $request->get('titulo');
            $texto = $request->get('texto');
            $obj = new Mensaje();
            $restaurante = $this->getDoctrine()->getRepository('ERPAdminBundle:Restaurante')->findById($idRestaurante);
            $obj->setRestauranteId($restaurante[0]);

            $obj->setTitulo($titulo);
            $obj->setTexto($texto);
            $obj->setHoraEnvio(new \DateTime());
            $obj->setFechaEnvio(new \DateTime());
            $obj->setFechaModificacion(new \DateTime());
            $obj->setFechaInsercion(new \DateTime());
            $obj->setEstado(1);
            $obj->setEstadoEnvio(0);
            $em->persist($obj);
            $em->flush();
            $idMensaje=$obj->getId();

            $this->render('ERPCRMBundle:envioMensajes/envioMensajesEnMomento.html.php', array
                ('idMensaje'=>$idMensaje));
            $data['estado']=true;
       return new Response(json_encode($data)); 

        
         }


        
        
    }

     /**
     * Insertar indentificador entities.
     *
     * @Route("/evaluarEdicionMensaje/", name="evaluarEdicionMensaje",options={"expose"=true})
     * @Method("POST")
     */
    public function EvaluarEditionMesageAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            
            $idMensaje = $request->get('idMensaje');
            $sql = "SELECT m.estado_envio FROM mensaje m WHERE
            m.id =$idMensaje";
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $valor= $stmt->fetchAll();
            $dato = $valor[0]['estado_envio'];
            if ($dato==1) {
                $data['estado']=false;
            }else{
                $data['estado']=true;
            }
           
            return new Response(json_encode($data)); 
         }

         
        
        
    }

      /**
     * SET Edicion de mensajes entities.
     *
     * @Route("/editarMensajesAndSend", name="editar_mensaje_and_send_action",options={"expose"=true})
     * @Method("POST")
     */
    public function EditarMensajesAndSendAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $em = $this->getDoctrine()->getManager();
        if($isAjax){
            
            $idMensaje =$request->get('idMensajes');
            $idRestaurante = $request->get('idRestaurante');
            $titulo = $request->get('titulo');
            $texto = $request->get('texto');

            $obj = $em->getRepository('ERPAdminBundle:Mensaje')->findById($idMensaje);

            $restaurante = $this->getDoctrine()->getRepository('ERPAdminBundle:Restaurante')->findById($idRestaurante);
            $obj[0]->setRestauranteId($restaurante[0]);
            $obj[0]->setTitulo($titulo);
            $obj[0]->setTexto($texto);
            $obj[0]->setHoraEnvio(new \DateTime());
            $obj[0]->setFechaEnvio(new \DateTime());
            $obj[0]->setFechaModificacion(new \DateTime());
            $obj[0]->setEstado(1);
            $em->merge($obj[0]);
            $em->flush();


            $this->render('ERPCRMBundle:envioMensajes/envioMensajesEnMomento.html.php', array
                ('idMensaje'=>$idMensaje));

            $data['estado']=true;
            return new Response(json_encode($data)); 
        
            
         }
        
        
    }

    
    
    
 }
