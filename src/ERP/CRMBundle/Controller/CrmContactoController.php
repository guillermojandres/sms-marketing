<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmContacto;
use ERP\AdminBundle\Form\CrmContactoType;
use Symfony\Component\HttpKernel\Exception;

/**
 * CrmContacto controller.
 *
 * @Route("/admin/CRM/contacto")
 */
class CrmContactoController extends Controller
{
    /**
     * Lists all CrmContacto entities.
     *
     * @Route("/", name="contacto_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $crmContactos = $em->getRepository('ERPAdminBundle:CrmContacto')->findAll();
        
        $crmContacto = new CrmContacto();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmContactoType', $crmContacto);
        $form->handleRequest($request);
        

        return $this->render('ERPCRMBundle:crmcontacto/index.html.twig', array(
            'crmContacto' => $crmContacto,
            'crmContactos' => $crmContactos,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new CrmContacto entity.
     *
     * @Route("/new", name="contacto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmContacto = new CrmContacto();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmContactoType', $crmContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmContacto);
            $em->flush();

            return $this->redirectToRoute('admin_contacto_show', array('id' => $crmContacto->getId()));
        }

        return $this->render('ERPCRMBundle:crmcontacto/new.html.twig', array(
            'crmContacto' => $crmContacto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CrmContacto entity.
     *
     * @Route("/{id}", name="admin_contacto_show")
     * @Method("GET")
     */
    public function showAction(CrmContacto $crmContacto)
    {
        $deleteForm = $this->createDeleteForm($crmContacto);

        return $this->render('crmcontacto/show.html.twig', array(
            'crmContacto' => $crmContacto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CrmContacto entity.
     *
     * @Route("/{id}/edit", name="contacto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmContacto $crmContacto)
    {
        $deleteForm = $this->createDeleteForm($crmContacto);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CrmContactoType', $crmContacto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmContacto);
            $em->flush();

            return $this->redirectToRoute('admin_contacto_edit', array('id' => $crmContacto->getId()));
        }

        return $this->render('ERPCRMBundle:crmcontacto/edit.html.twig', array(
            'crmContacto' => $crmContacto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CrmContacto entity.
     *
     * @Route("/{id}", name="admin_contacto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmContacto $crmContacto)
    {
        $form = $this->createDeleteForm($crmContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmContacto);
            $em->flush();
        }

        return $this->redirectToRoute('admin_contacto_index');
    }

    /**
     * Creates a form to delete a CrmContacto entity.
     *
     * @param CrmContacto $crmContacto The CrmContacto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmContacto $crmContacto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_contacto_delete', array('id' => $crmContacto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    

  /**
     * 
     *
     * @Route("/contacto/data", name="contacto_datas")
     */
    public function dataContactoAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CrmContacto();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CrmContacto')->findAll();
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
        
                    $dql = "SELECT con.id , con.nombre  ,con.telefono, con.emailId ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcontacto\" id=\"',con.id), '\">' as link FROM ERPAdminBundle:CrmContacto con "
                        . "WHERE upper(con.nombre)  LIKE upper(:busqueda) OR upper(con.emailId)  LIKE upper(:busqueda) "
                        . "ORDER BY con.nombre DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                    $dql = "SELECT con.id , con.nombre  ,con.telefono, con.emailId ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcontacto\" id=\"',con.id), '\">' as link FROM ERPAdminBundle:CrmContacto con "
                        . "WHERE upper(con.nombre)  LIKE upper(:busqueda) OR upper(con.emailId)  LIKE upper(:busqueda) "
                        . "ORDER BY con.nombre DESC ";
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT con.id , con.nombre  ,con.telefono, con.emailId ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcontacto\" id=\"',con.id), '\">' as link FROM ERPAdminBundle:CrmContacto con  "
                   . "ORDER BY con.nombre DESC ";
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
    * @Route("/attributes/insert/clientepotencial", name="insert_contacto")
    */
    public function insertarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $entity = new CrmContacto();
           $entity->setNombre($data[0]);
           $entity->setApellido($data[1]);
           $entity->setTelefono($data[2]);
           $entity->setEmailId($data[3]);
           $entity->setNumeroMovil($data[4]);
           $entity->setDepartamento($data[5]);
           $entity->setPuesto($data[6]);
        

           $id_proveedor = $em->getRepository('ERPAdminBundle:InvProveedor')->find($data[7]);
           $id_clienteP = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($data[8]);
           $id_cliente = $em->getRepository('ERPAdminBundle:CrmCliente')->find($data[9]);
           
           
           $entity->setContactoProveedorId($id_proveedor);
           $entity->setContactoClientePotencialId($id_clienteP);
           $entity->setContactoClienteId($id_cliente);
           

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
    * @Route("/attributes/edit/cliente", name="edit_contacto")
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
          $entity = $em->getRepository('ERPAdminBundle:CrmContacto')->find($data[0]);
          
           $entity->setNombre($data[1]);
           $entity->setApellido($data[2]);
           $entity->setTelefono($data[3]);
           $entity->setEmailId($data[4]);
           $entity->setNumeroMovil($data[5]);
           $entity->setDepartamento($data[6]);
           $entity->setPuesto($data[7]);
        

           $id_proveedor = $em->getRepository('ERPAdminBundle:InvProveedor')->find($data[8]);
           $id_clienteP = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($data[9]);
           $id_cliente = $em->getRepository('ERPAdminBundle:CrmCliente')->find($data[10]);
           
           
           $entity->setContactoProveedorId($id_proveedor);
           $entity->setContactoClientePotencialId($id_clienteP);
           $entity->setContactoClienteId($id_cliente);
    
  

           
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
     * @Route("/admin/CMR/deletecontacto", name="delete_contacto")
     */
    public function deleteContactoAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
     
        $response = new JsonResponse();
      
            $idcontacto = $this->get('request')->request->get('idcontacto');
            
 
           foreach($idcontacto as $row){
             $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CrmContacto')->find($row);
               $em->remove($detalleOrden);
              $em->flush();
              
          }
  
           $response->setData(array(
                           'flag' => 0,
                           
                    ));    
            return $response; 
       
        
        
        
    }   
    
    
    
    
    
}
