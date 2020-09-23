<?php

namespace ERP\CRMBundle\Controller;
use ERP\AdminBundle\Entity\DetalleRestauranteCliente;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception;
use ERP\AdminBundle\Entity\Cliente;

/**
 * restaurante controller.
 *
 * @Route("admin/clientes")
 */
class ClienteController extends Controller
{
    /**
     * Lists all clientes entities.
     *
     * @Route("/", name="admin_cliente_index",options={"expose"=true})
     * @Method("GET")
     */
    public function indexAction()
    {
        
        return $this->render('ERPCRMBundle:clientes/index.html.twig', array(
        ));
    }

    
      /**
     *
     *
     * @Route("/allClientesData/data", name="all_clientes_data", options={"expose"=true})
     */
    public function dataFacturacionAction(Request $request)
    {
                $em = $this->getDoctrine()->getManager();
                $start = $request->query->get('start');
                $draw = $request->query->get('draw');
                $longitud = $request->query->get('length');
                $busqueda = $request->query->get('search');
               
                $restaurante = $request->query->get('param1');
                $fechaini = $request->query->get('param2');
                $fechafin = $request->query->get('param3');
                

                 $ordenamientoVariable = $request->query->get('order');
                

                $columna = $ordenamientoVariable[0]['column'];
                $tipoOrdenamiento = $ordenamientoVariable[0]['dir'];
                
                if ($columna=='0'){
                    
                      $orden=" c.id ".$tipoOrdenamiento;
                    
                }else if ($columna=='1'){
                     $orden=" c.telefono ".$tipoOrdenamiento;
                    
                }else  if ($columna=='2'){
                 $x="fecha_creacion";
                 $orden="c.".$x." ".$tipoOrdenamiento;

                    
                }
                
               
              // $restaurante);
              //  var_dump($fechaini);
              //  var_dump($fechafin);
              //  die();
               
                $facturacionTotal = $em->getRepository('ERPAdminBundle:Cliente')->findAll();
                $facturacion['draw']=$draw++; 
                $facturacion['data']= array();
               
                $busqueda['value'] = str_replace(' ', '%', $busqueda['value']);
                $rsm = new ResultSetMapping();
                
                $sql = "SELECT concat_ws(c.id, '<div class=\"text-center\">', '</div>') as id, "
                        . "concat_ws(c.telefono, '<div class=\"text-center\">', '</div>') as telefono, "
                        . "concat_ws(DATE_FORMAT(det.fecha_creacion,'%d-%m-%Y'), '<div class=\"text-center\">', '</div>') as fecha_creacion, "
                        . "concat_ws(CASE 
                             WHEN det.estado='1' THEN 'Activo'
                             WHEN det.estado='2' THEN 'Inactivo'
                            END, '<div class=\"text-center\">', '</div>') as estado "
                        . "FROM detalle_restaurante_cliente det inner join cliente c on  det.cliente_id = c.id "
                        . "WHERE 1 = 1 ";
                      

                if($restaurante != NULL){
                    $sql.="AND det.restaurante_id=$restaurante ";
                }
               
             
                if($fechaini != "" && $fechafin != ""){

                   
                    $sql.=" AND  det.fecha_creacion >= '$fechaini' AND det.fecha_creacion <= '$fechafin' ";
                }

                //echo $sql;
                $rsm->addScalarResult('id','id');
                $rsm->addScalarResult('telefono','telefono');
                $rsm->addScalarResult('fecha_creacion','fecha_creacion');
                $rsm->addScalarResult('estado','estado');
               

                $facturacion['data'] = $em->createNativeQuery($sql, $rsm)
                                          ->getResult();
                $facturacion['recordsTotal'] = count($facturacionTotal);
                $facturacion['recordsFiltered']= count($facturacionTotal);
               
                return new Response(json_encode($facturacion));
    }
     
     /**
     * Insertar indentificador entities.
     *
     * @Route("/extraerUsuarios/", name="extraer_usuarios",options={"expose"=true})
     * @Method("POST")
     */
    public function ExtraerUsuriosMensajeAction(Request $request)
    {
        $isAjax = $this->get('Request')->isXMLhttpRequest();
       
        if($isAjax){
            
            $em = $this->getDoctrine()->getManager();
            
            $id = $request->get('id');
             $idRestaurante= $request->get('idRestaurante');

            if ($id==1) {
                    $sql1 = "SELECT count(*) as numero FROM detalle_restaurante_cliente det WHERE det.estado=1  ";
                    $stmt1 = $em->getConnection()->prepare($sql1);
                    $stmt1->execute();
                    $data['activos'] = $stmt1->fetchAll();

                     $sql2 = "SELECT count(*) as numero FROM detalle_restaurante_cliente det WHERE det.estado=0  ";
                    $stmt2 = $em->getConnection()->prepare($sql2);
                    $stmt2->execute();
                    $data['inactivos'] = $stmt2->fetchAll();

                    $data["estado"]=true;
                    return new Response(json_encode($data)); 
            }

            if ($idRestaurante!=0) {
                 $sql1 = "SELECT count(*) as numero FROM detalle_restaurante_cliente det WHERE det.estado=1 AND det.restaurante_id=$idRestaurante ";
                    $stmt1 = $em->getConnection()->prepare($sql1);
                    $stmt1->execute();
                    $data['activos'] = $stmt1->fetchAll();

                     $sql2 = "SELECT count(*) as numero FROM detalle_restaurante_cliente det WHERE det.estado=0  AND det.restaurante_id=$idRestaurante ";
                    $stmt2 = $em->getConnection()->prepare($sql2);
                    $stmt2->execute();
                    $data['inactivos'] = $stmt2->fetchAll();

                    $data["estado"]=true;
                    return new Response(json_encode($data)); 
                
            }
            
            

            
            
         }
        
        
    }


    /**
     * @Route("/insertarListaCliente/data", name="insertarListaCliente", options={"expose"=true})
     * @Method("POST")
     */

    public function InsertarListaClienteAction(Request $request)
    {

        $isAjax = $this->get('Request')->isXMLhttpRequest();


        if ($isAjax) {
//        try{
            $em = $this->getDoctrine()->getManager();
            if (count($_FILES) > 0) {
                $idNegocio = $_POST["idNegocio"];
                $restaurante = $em->getRepository('ERPAdminBundle:Restaurante')->findBy(array("id"=>$idNegocio));
                $path = $this->container->getParameter('clienteFiles');

                $nombreReal = $_FILES["archivos"]["name"];
                $nombreTemp = $_FILES["archivos"]["tmp_name"];
                $success = move_uploaded_file($nombreTemp, $path . "/" . $nombreReal);
                if ($success) {
                    $i=0;
                    $file = fopen($path.$nombreReal, 'r');
                    while (($line = fgetcsv($file)) !== FALSE) {
                       if ($i>0){
//Aqui comienza la validacion de los datos de ingreso
                           $banderacliente =false;
                           $sqlCliente ="select count(c.id) as numero from cliente c where c.telefono ='".$line[0]."'";
                           $stmt = $em->getConnection()->prepare($sqlCliente);
                           $stmt->execute();
                           $info= $stmt->fetchAll();
                           $banderacliente =$info[0]['numero'];
                           if ($banderacliente==0){
                               $objCliente = new Cliente();
                               $objCliente->setTelefono("+503".$line[0]);
                               $objCliente->setEstado(1);
                               $objCliente->setFechaInsercion(new \DateTime("now"));
                               $objCliente->setFechaModificacion(new \DateTime("now"));
                               $objCliente->setFechaBaja(new \DateTime("now"));
                               $em->persist($objCliente);
                               $em->flush();

                               $cliente = $em->getRepository('ERPAdminBundle:Cliente')->findBy(array("id"=>$objCliente->getId()));
                               $objDetalleRestaurante = new DetalleRestauranteCliente();
                               $objDetalleRestaurante->setFechaInsercion(new \DateTime("now"));
                               $objDetalleRestaurante->setFechaModificacion(new \DateTime("now"));
                               $objDetalleRestaurante->setFechaBaja(new \DateTime("now"));
                               $objDetalleRestaurante->setEstado(1);
                               $objDetalleRestaurante->setCliente($cliente[0]);
                               $objDetalleRestaurante->setRestaurante($restaurante[0]);
                               $em->persist($objDetalleRestaurante);
                               $em->flush();
                           }


                       }
                       $i++;
                    }

                    $data['estado'] = true;
                    $data['descripcion'] = 'Cliente y contactos ingresados exitosamente!!';
                }

            }


//            } catch (\Exception $exc) {
//        $data["estado"]=false;
//        $data['descripcion']='Error al ingresar el registro!'.$exc;
//        return new JsonResponse($data);
//
//    }


        }

        return new Response(json_encode($data));


    }
}