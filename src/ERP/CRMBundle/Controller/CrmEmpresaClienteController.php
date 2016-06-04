<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmEmpresaCliente;
use ERP\AdminBundle\Form\CrmEmpresaClienteType;
use Symfony\Component\HttpKernel\Exception;

/**
 * CrmEmpresaCliente controller.
 *
 * @Route("/admin/CRM/empresacliente")
 */
class CrmEmpresaClienteController extends Controller
{
    /**
     * Lists all CrmEmpresaCliente entities.
     *
     * @Route("/", name="empresacliente_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $crmEmpresaClientes = $em->getRepository('ERPAdminBundle:CrmEmpresaCliente')->findAll();
        
        $crmEmpresaCliente = new CrmEmpresaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmEmpresaClienteType', $crmEmpresaCliente);
        $form->handleRequest($request);

        return $this->render('ERPCRMBundle:crmempresacliente/index.html.twig', array(
              'crmEmpresaCliente' => $crmEmpresaCliente,
            'crmEmpresaClientes' => $crmEmpresaClientes,
             'form' => $form->createView(),
        ));
        
    }

    /**
     * Creates a new CrmEmpresaCliente entity.
     *
     * @Route("/new", name="empresacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmEmpresaCliente = new CrmEmpresaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmEmpresaClienteType', $crmEmpresaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmEmpresaCliente);
            $em->flush();

            return $this->redirectToRoute('admin_empresacliente_show', array('id' => $crmEmpresaCliente->getId()));
        }

        return $this->render('ERPCRMBundle:crmempresacliente/new.html.twig', array(
            'crmEmpresaCliente' => $crmEmpresaCliente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CrmEmpresaCliente entity.
     *
     * @Route("/{id}", name="admin_empresacliente_show")
     * @Method("GET")
     */
    public function showAction(CrmEmpresaCliente $crmEmpresaCliente)
    {
        $deleteForm = $this->createDeleteForm($crmEmpresaCliente);

        return $this->render('crmempresacliente/show.html.twig', array(
            'crmEmpresaCliente' => $crmEmpresaCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CrmEmpresaCliente entity.
     *
     * @Route("/{id}/edit", name="empresacliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmEmpresaCliente $crmEmpresaCliente)
    {
        $deleteForm = $this->createDeleteForm($crmEmpresaCliente);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CrmEmpresaClienteType', $crmEmpresaCliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmEmpresaCliente);
            $em->flush();

            return $this->redirectToRoute('empresacliente_edit', array('id' => $crmEmpresaCliente->getId()));
        }

        return $this->render('ERPCRMBundle:crmempresacliente/edit.html.twig', array(
            'crmEmpresaCliente' => $crmEmpresaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CrmEmpresaCliente entity.
     *
     * @Route("/{id}", name="admin_empresacliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmEmpresaCliente $crmEmpresaCliente)
    {
        $form = $this->createDeleteForm($crmEmpresaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmEmpresaCliente);
            $em->flush();
        }

        return $this->redirectToRoute('admin_empresacliente_index');
    }

    /**
     * Creates a form to delete a CrmEmpresaCliente entity.
     *
     * @param CrmEmpresaCliente $crmEmpresaCliente The CrmEmpresaCliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmEmpresaCliente $crmEmpresaCliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_empresacliente_delete', array('id' => $crmEmpresaCliente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
   /**
     * 
     *
     * @Route("/empresa/data", name="empresa_data")
     */
    public function dataEmpresaAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CrmEmpresaCliente();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CrmEmpresaCliente')->findBy(array('estado'=>1));
        
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
        
                    $dql = "SELECT emp.id , emp.nombre,emp.direccion ,emp.nrc,emp.nit,emp.giro,emp.tel,emp.fax,emp.correo ,concat(concat('<input type=\"checkbox\" class=\"checkbox idempresa\" id=\"',emp.id), '\">' as link FROM ERPAdminBundle:CrmEmpresaCliente emp  "
                        . "WHERE upper(emp.nombre)  LIKE upper(:busqueda) OR upper(emp.nrc)  LIKE upper(:busqueda)  OR upper(emp.nit)  LIKE upper(:busqueda)  and emp.estado=1 "
                        . "ORDER BY emp.nombre DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                      $dql = "SELECT emp.id , emp.nombre,emp.direccion ,emp.nrc,emp.nit,emp.giro,emp.tel,emp.fax,emp.correo ,concat(concat('<input type=\"checkbox\" class=\"checkbox idempresa\" id=\"',emp.id), '\">' as link FROM ERPAdminBundle:CrmEmpresaCliente emp  "
                        . "WHERE upper(emp.nombre)  LIKE upper(:busqueda) OR upper(emp.nrc)  LIKE upper(:busqueda)  OR upper(emp.nit)  LIKE upper(:busqueda)  and emp.estado=1 "
                        . "ORDER BY emp.nombre DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT emp.id , emp.nombre,emp.direccion ,emp.nrc,emp.nit,emp.giro,emp.tel,emp.fax,emp.correo ,concat(concat('<input type=\"checkbox\" class=\"checkbox idempresa\" id=\"',emp.id), '\">' as link FROM ERPAdminBundle:CrmEmpresaCliente emp "
                . " WHERE emp.estado=1 ORDER BY emp.nombre  DESC ";
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
    * @Route("/attributes/insert/empresa", name="insert_empresa")
    */
    public function insertarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $entity = new CrmEmpresaCliente();
           $entity->setNombre($data[0]);
           $entity->setDireccion($data[1]);
           $entity->setNrc($data[2]);
           $entity->setNit($data[3]);
           $entity->setGiro($data[4]);
           $entity->setTel($data[5]);
           $entity->setFax($data[6]);
           $entity->setCorreo($data[7]);
           $entity->setEstado(1);
           
//                $industria = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($data[2]);
//                $entity->setCrmIndustriaCliente($industria);
           
                $em->persist($entity);
                $em->flush();
                $response->setData(array(
                           'flag'       => 1
                    )); 
                return $response;

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
    * @Route("/attributes/edit/proveedor", name="edit_empresa")
    */
    public function editarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $entity = $em->getRepository('ERPAdminBundle:CrmEmpresaCliente')->find($data[0]);
           $entity->setNombre($data[1]);
           $entity->setDireccion($data[2]);
           $entity->setNrc($data[3]);
           $entity->setNit($data[4]);
           $entity->setGiro($data[5]);
           $entity->setTel($data[6]);
           $entity->setFax($data[7]);
           $entity->setCorreo($data[8]);
           
//                $proveedor->setEstado(1);
                
//                $industria = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($data[3]);
//                $proveedor->setCrmIndustriaCliente($industria);
           
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
     * @Route("/admin/orders/delete/deletedetalle", name="delete_empresa")
     */
    public function deleteTerritorioAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        //var_dump($isAjax);
        $response = new JsonResponse();
        //if($isAjax){
            $idempresa = $this->get('request')->request->get('idempresa');
//            $ordenId = $this->get('request')->request->get('ordenId');
            //var_dump($id_territorio);
            
            foreach($idempresa as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CrmEmpresaCliente')->find($row);
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
