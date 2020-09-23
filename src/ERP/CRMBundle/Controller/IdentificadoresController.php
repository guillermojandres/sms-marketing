<?php

namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception;
use ERP\AdminBundle\Entity\Identificador;


/**
 * ClientePotencial controller.
 *
 * @Route("admin/identificadores")
 */
class IdentificadoresController extends Controller
{
    /**
     * Lists all Identificadores entities.
     *
     * @Route("/", name="identificadores_dashboard",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        
        return $this->render('ERPCRMBundle:identificadores/dashboardIdentificadores.html.twig', array(
            
        ));
    }
    
    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/lista", name="listaIdentificadores",options={"expose"=true})
     * @Method("GET")
     */
    public function ListaIdentificadoresAction()
    {
        
        return $this->render('ERPCRMBundle:identificadores/index.html.twig', array(
            
        ));
    }

    /**
     * Lists all ClientePotencial entities.
     *
     * @Route("/nuevo/", name="nuevo_identificador",options={"expose"=true})
     * @Method("GET")
     */
    public function CallNewIdentificadorAction()
    {
        
        return $this->render('ERPCRMBundle:identificadores/nuevo.html.twig', array(
            
        ));
    }

     /**
    * Ajax utilizado para buscar informacion de contactos
    * 
    * @Route("/buscarRestaurante", name="buscarRestaurante",options={"expose"=true})
    */
    public function BuscarResctauranteAction(Request $request)
    {
        $busqueda = $request->query->get('q');
        $page = $request->query->get('page');
       
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT rs.id idRestaurante, rs.nombre  "
                        . "FROM ERPAdminBundle:Restaurante rs "
                        . "WHERE upper(rs.nombre) LIKE upper(:busqueda)"
                        . " AND rs.estado=1 "
                        . "ORDER BY rs.nombre ASC ";
       
        $restaurante['data'] = $em->createQuery($dql)
                ->setParameters(array('busqueda'=>"%".$busqueda."%"))
                ->setMaxResults( 10 )
                ->getResult();
        return new Response(json_encode($restaurante));
    }
    
    


    /**
     * 
     *
     * @Route("/identificadores/lista/", name="identificadores_data_all",options={"expose"=true})
     */
    public function IdentificadoresDataAction(Request $request)
    {
        
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Easy set variables
     */
    
    /* Array of database columns which should be read and sent back to DataTables. Use a space where
     * you want to insert a non-database field (for example a counter or static image)
     */
        $entity = new Identificador();
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getManager();
        $identificador = $em->getRepository('ERPAdminBundle:Identificador')->findAll();
        $territorio['draw']=$draw++;  
        $territorio['recordsTotal'] = count($identificador);
        $territorio['recordsFiltered']= count($identificador);
        
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
            $x='serie';
            
            
        }else  if ($columna=='2'){
            
            $x='incentivo';
        
            
        }
        
        

        if($busqueda['value']!=''){
          $value = $busqueda['value'];  
           
          $sql = "SELECT ide.id as id, ide.serie as serie, rs.nombre as restaurante, ide.incentivo as incentivo FROM restaurante_identificadores ide 
                    LEFT OUTER JOIN restaurante rs  ON ide.id = rs.id "
                    . " WHERE (upper(rs.nombre)  LIKE '%".strtoupper($value)."%' OR ide.serie LIKE '%".strtoupper($value)."%') AND ide.estado=1 "
                    . "ORDER BY id.".$x." ".$tipoOrdenamiento;
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $territorio['data'] = $stmt->fetchAll();
             $territorio['recordsFiltered']= count($territorio['data']);
                 
       
        }
        else{
        $sql = "SELECT ide.id as id, ide.serie as serie, rs.nombre as restaurante, ide.incentivo as incentivo FROM restaurante_identificadores ide
            LEFT OUTER JOIN restaurante as rs  ON ide.restaurante_id = rs.id  WHERE ide.estado=1 ORDER BY ide.serie ".$tipoOrdenamiento;
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
     * @Route("/insertarIdentificador/", name="insertar_identificador",options={"expose"=true})
     * @Method("POST")
     */
    public function NewIdentificadortAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            
            $serie = $request->get('serie');


            $sql = "SELECT count(*) as numero FROM  restaurante_identificadores WHERE serie='$serie'";
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $dato= $stmt->fetchAll();
            if (count($dato)==0) {
                $idRestaurante = $request->get('idRestaurante');
            
                $incentivo = $request->get('incentivo');
                $obj = new Identificador();
                $obj->setSerie($serie);
                $obj->setIncentivo($incentivo);

                $restaurante = $this->getDoctrine()->getRepository('ERPAdminBundle:Restaurante')->findById($idRestaurante);
                      $obj->setRestauranteId($restaurante[0]);

                $obj->setEstado(1);
                $em->persist($obj);
                $em->flush();
                $data['estado']=true;

            }else{
                 $data['estado']=0;
            }


            


             



            


            return new Response(json_encode($data)); 
            
         }
        
        
    }

    /**
     * @Route("/{id}", name="editar_identificador", options={"expose"=true})
     * @Method("GET")
     */
    public function CallEditaridentificadoresAction($id)
    {
        
      
        
        $em = $this->getDoctrine()->getManager();
        $identificadores = $em->getRepository('ERPAdminBundle:Identificador')->findById($id);
        return $this->render('ERPCRMBundle:identificadores/editar.html.twig', array(
            'identificadores' => $identificadores,
        ));
    }
    
    /**
     * Displays a form to edit an existing Orden entity.
     *
     * @Route("/identificadores/eliminaridentificadores", name="eliminar_identificador",options={"expose"=true})
     */
    public function EliminaridentificadoresAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        
            $idEliminar = $this->get('request')->request->get('idEliminar');
     
           
                $em = $this->getDoctrine()->getManager();
                $obj = $em->getRepository('ERPAdminBundle:Identificador')->find($idEliminar);    
                $obj->setEstado(0);
                $em->persist($obj);
                $em->flush();

            
       $data['estado']=true;
       return new Response(json_encode($data)); 
        
        
        
    }


     /**
     * SET NEW identificadores entities.
     *
     * @Route("/editaridentificadores/edicion", name="editar_identificadores_action",options={"expose"=true})
     * @Method("POST")
     */
    public function EditaridentificadoresAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('idIdentificador');
            $idRestaurante = $request->get('idRestaurante');
            $serie = $request->get('serie');
            $incentivo = $request->get('incentivo');


            $sql = "SELECT count(*) as numero FROM  restaurante_identificadores WHERE serie='$serie'";
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $dato= $stmt->fetchAll();

            if (count($dato)<=1) {

                $obj = $em->getRepository('ERPAdminBundle:Identificador')->findById($id);
                $restaurante = $this->getDoctrine()->getRepository('ERPAdminBundle:Restaurante')->findById($idRestaurante);
                $obj[0]->setRestauranteId($restaurante[0]);
                $obj[0]->setSerie($serie);
                $obj[0]->setIncentivo($incentivo);
       
                $em->merge($obj[0]);
                $em->flush();
                $data['estado']=true;
            }else{
                 $data['estado']=0;
            }

            return new Response(json_encode($data)); 
            
         }
        
        
    }
    
    
    
 }
