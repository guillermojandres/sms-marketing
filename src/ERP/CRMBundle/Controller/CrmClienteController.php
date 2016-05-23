<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmCliente;
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
     * @Route("/", name="cliente_index")
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
     * @Route("/{id}/edit", name="cliente_edit")
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
            
           $entity = new CrmCliente();
           $entity->setNombreCompleto($data[0]);
           $entity->setSitioWeb($data[1]);
           $entity->setDatosCliente($data[2]); 
          $id_categoriaCliente = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->find($data[3]);
          $id_clientepot = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($data[4]);
          $id_territorio= $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($data[5]);
           
           $var ="";
           if ($data[6]==0) {
               $var = "Individual"; 
           }
               else{
                   $var = "Compañia";
                    }
            $entity->setCategoriaCliente($id_categoriaCliente);
            $entity->setClientePotencial($id_clientepot);
            $entity->setTerritorio($id_territorio);
            
            $entity->setTipo($var);
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
            
//           var_dump($data);
//           die;
          $entity = $em->getRepository('ERPAdminBundle:CrmCliente')->find($data[0]);
          $entity->setNombreCompleto($data[1]);
          $entity->setSitioWeb($data[2]);
          $entity->setDatosCliente($data[3]); 
          $id_categoriaCliente = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->find($data[4]);
          $id_clientepot = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($data[5]);
          $id_territorio= $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($data[6]);
           
           $var ="";
           if ($data[7]==0) {
               $var = "Individual"; 
           }
               else{
                   $var = "Compañia";
                    }
            $entity->setCategoriaCliente($id_categoriaCliente);
            $entity->setClientePotencial($id_clientepot);
            $entity->setTerritorio($id_territorio);
            $entity->setTipo($var);
    
  

           
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
   
  
    
    
    
}
