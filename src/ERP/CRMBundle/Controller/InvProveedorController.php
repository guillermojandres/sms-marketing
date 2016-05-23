<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\InvProveedor;
use ERP\AdminBundle\Form\InvProveedorType;
use Symfony\Component\HttpKernel\Exception;

/**
 * InvProveedor controller.
 *
 * @Route("/admin/CRM/invproveedor")
 */
class InvProveedorController extends Controller
{
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/", name="invproveedor_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $invProveedors = $em->getRepository('ERPAdminBundle:InvProveedor')->findAll();
        
        $invProveedor = new InvProveedor();
        $form = $this->createForm('ERP\AdminBundle\Form\InvProveedorType', $invProveedor);
        $form->handleRequest($request);

        return $this->render('ERPCRMBundle:invproveedor/index.html.twig', array(
            'invProveedor' => $invProveedor,
            'invProveedors' => $invProveedors,
            'form' => $form->createView(),
           
        ));
    }

    /**
     * Creates a new InvProveedor entity.
     *
     * @Route("/new", name="invproveedor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invProveedor = new InvProveedor();
        $form = $this->createForm('ERP\AdminBundle\Form\InvProveedorType', $invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $invProveedor->setEstado(1); 
            
            
            $em->persist($invProveedor);
            $em->flush();

            return $this->redirectToRoute('invproveedor_index', array('id' => $invProveedor->getId()));
        }

        return $this->render('ERPCRMBundle:invproveedor/new.html.twig', array(
            'invProveedor' => $invProveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InvProveedor entity.
     *
     * @Route("/{id}", name="admin_invproveedor_show")
     * @Method("GET")
     */
    public function showAction(InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);

        return $this->render('invproveedor/show.html.twig', array(
            'invProveedor' => $invProveedor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InvProveedor entity.
     *
     * @Route("/{id}/edit", name="invproveedor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);
        $editForm = $this->createForm('ERP\AdminBundle\Form\InvProveedorType', $invProveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invProveedor);
            $em->flush();

            return $this->redirectToRoute('invproveedor_index', array('id' => $invProveedor->getId()));
        }
        
        return $this->render('ERPCRMBundle:invproveedor/edit.html.twig', array(
            'invProveedor' => $invProveedor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InvProveedor entity.
     *
     * @Route("/{id}", name="admin_invproveedor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InvProveedor $invProveedor)
    {
        $form = $this->createDeleteForm($invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invProveedor);
            $em->flush();
        }

        return $this->redirectToRoute('admin_invproveedor_index');
    }

    /**
     * Creates a form to delete a InvProveedor entity.
     *
     * @param InvProveedor $invProveedor The InvProveedor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvProveedor $invProveedor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_invproveedor_delete', array('id' => $invProveedor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     
    /**
     * 
     *
     * @Route("/proveedor/data", name="invproveedor_data")
     */
    public function dataProveedorAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new InvProveedor();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:InvProveedor')->findBy(array('estado'=>1));
        
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
        
                    $dql = "SELECT pro.id , pro.nombre,pro.direccion ,ind.descripcion ,concat(concat('<input type=\"checkbox\" class=\"checkbox idproveedor\" id=\"',pro.id), '\">' as link FROM ERPAdminBundle:InvProveedor pro  "
                        . "JOIN pro.crmIndustriaCliente ind "
                        . "WHERE upper(pro.nombre)  LIKE upper(:busqueda) OR upper(ind.descripcion)  LIKE upper(:busqueda)  and pro.estado=1 "
                        . "ORDER BY pro.nombre DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                     $dql = "SELECT pro.id , pro.nombre,pro.direccion  ,ind.descripcion ,concat(concat('<input type=\"checkbox\" class=\"checkbox idproveedor\" id=\"',pro.id), '\">' as link FROM ERPAdminBundle:InvProveedor pro  "
                        . "JOIN pro.crmIndustriaCliente ind "
                        . "WHERE upper(pro.nombre) LIKE upper(:busqueda) OR upper(ind.descripcion)  LIKE upper(:busqueda)  and pro.estado=1 "
                        . "ORDER BY pro.nombre DESC ";
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT pro.id , pro.nombre,pro.direccion ,ind.descripcion ,concat(concat('<input type=\"checkbox\" class=\"checkbox idproveedor\" id=\"',pro.id), '\">' as link FROM ERPAdminBundle:InvProveedor pro "
                    . "JOIN pro.crmIndustriaCliente ind "
                . " WHERE pro.estado=1 ORDER BY pro.nombre  DESC ";
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
    * @Route("/attributes/insert/proveedor", name="insert_proveedor")
    */
    public function insertarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            //var_dump($data);
            //die();
           $entity = new InvProveedor();
           $entity->setNombre($data[0]);
           $entity->setDireccion($data[1]);
//           try {
                $entity->setEstado(1);
                $industria = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($data[2]);
                $entity->setCrmIndustriaCliente($industria);
           
                $em->persist($entity);
                $em->flush();
                $response->setData(array(
                           'flag'       => 1
                    )); 
                return $response;
//           } catch (\Doctrine\DBAL\Exception\ConnectionException $e) {
//               
//               $mensaje = $e->getMessage();
//               $response->setData(array(
//                           'flag'       => utf8_decode($e->getMessage())
//                    ));  
//               return $response; 
//           }
          
           
            
            

            
        } else {    
            
            $response->setData(array(
                           'flag'       => $mensaje
                    ));  
            return $response; 
        }  
    }
   
    
  
    
    
    /**
    * Ajax utilizado para buscar el precio del atributo seleccionado
    *  
    * @Route("/attributes/edit/proveedor", name="edit_proveedor")
    */
    public function editarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $proveedor = $em->getRepository('ERPAdminBundle:InvProveedor')->find($data[0]);
           $proveedor->setNombre($data[1]);
           $proveedor->setDireccion($data[2]);
           
//                $proveedor->setEstado(1);
                
                $industria = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($data[3]);
                $proveedor->setCrmIndustriaCliente($industria);
           
                $em->merge($proveedor);
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
     * @Route("/admin/orders/delete/deletedetalle", name="delete_proveedor")
     */
    public function deleteTerritorioAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        //var_dump($isAjax);
        $response = new JsonResponse();
        //if($isAjax){
            $idproveedor = $this->get('request')->request->get('idproveedor');
//            $ordenId = $this->get('request')->request->get('ordenId');
            //var_dump($id_territorio);
            
            foreach($idproveedor as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:InvProveedor')->find($row);
                $detalleOrden->setEstado(0);
                $em->persist($detalleOrden);
                $em->flush();
                
            }
   
            $response->setData(array(
                            'flag' => 0,
                            
                    ));    
            return $response; 
       
        
        
        
    }
   
    
  
   
    
    
    
    
    
    
}
