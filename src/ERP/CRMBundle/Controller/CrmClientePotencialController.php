<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmClientePotencial;
use ERP\AdminBundle\Form\CrmClientePotencialType;
use Symfony\Component\HttpKernel\Exception;


/**
 * CrmClientePotencial controller.
 *
 * @Route("/admin/CRM/clientepotencial")
 */
class CrmClientePotencialController extends Controller
{
    /**
     * Lists all CrmClientePotencial entities.
     *
     * @Route("/", name="clientepotencial_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $crmClientePotencials = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->findAll();
        
        
        $crmClientePotencial = new CrmClientePotencial();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClientePotencialType', $crmClientePotencial);
        $form->handleRequest($request);

        return $this->render('ERPCRMBundle:crmclientepotencial/index.html.twig', array(
            'crmClientePotencials' => $crmClientePotencials,
            'crmClientePotencial' => $crmClientePotencial,
            'form' => $form->createView(),
           
        ));
    }

    
    
    
    /**
     * Creates a new CrmClientePotencial entity.
     *
     * @Route("/new", name="clientepotencial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmClientePotencial = new CrmClientePotencial();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClientePotencialType', $crmClientePotencial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmClientePotencial);
            $em->flush();

            return $this->redirectToRoute('admin_clientepotencial_show', array('id' => $crmClientePotencial->getId()));
        }

        return $this->render('ERPCRMBundle:crmclientepotencial/new.html.twig', array(
            'crmClientePotencial' => $crmClientePotencial,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CrmClientePotencial entity.
     *
     * @Route("/{id}", name="admin_clientepotencial_show")
     * @Method("GET")
     */
    public function showAction(CrmClientePotencial $crmClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($crmClientePotencial);

        return $this->render('crmclientepotencial/show.html.twig', array(
            'crmClientePotencial' => $crmClientePotencial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CrmClientePotencial entity.
     *
     * @Route("/{id}/edit", name="clientepotencial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmClientePotencial $crmClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($crmClientePotencial);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CrmClientePotencialType', $crmClientePotencial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmClientePotencial);
            $em->flush();

            return $this->redirectToRoute('clientepotencial_index', array('id' => $crmClientePotencial->getId()));
        }

        return $this->render('ERPCRMBundle:crmclientepotencial/edit.html.twig', array(
            'crmClientePotencial' => $crmClientePotencial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    

    /**
     * Deletes a CrmClientePotencial entity.
     *
     * @Route("/{id}", name="admin_clientepotencial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmClientePotencial $crmClientePotencial)
    {
        $form = $this->createDeleteForm($crmClientePotencial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmClientePotencial);
            $em->flush();
        }

        return $this->redirectToRoute('admin_clientepotencial_index');
    }

    /**
     * Creates a form to delete a CrmClientePotencial entity.
     *
     * @param CrmClientePotencial $crmClientePotencial The CrmClientePotencial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmClientePotencial $crmClientePotencial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_clientepotencial_delete', array('id' => $crmClientePotencial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
   
    
   /**
     * 
     *
     * @Route("/clientepotencial/data", name="clientepotencial_data")
     */
    public function dataClientePotencialAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CrmClientePotencial();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->findAll();
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
        
                    $dql = "SELECT cp.id , cp.nombre as nombreCp,cp.emailId,emp.nombre,emp.nombre as nombreE,cp.telefono,cp.movil,cp.sector_mercado ,concat(concat('<input type=\"checkbox\" class=\"checkbox idclientepotencial\" id=\"',cp.id), '\">' as link FROM ERPAdminBundle:CrmClientePotencial cp  "
                        . "JOIN cp.crmEmpresaCliente emp "
                        . "WHERE upper(cp.nombre)  LIKE upper(:busqueda) OR upper(emp.nombre)  LIKE upper(:busqueda)"
                        . "ORDER BY cp.nombre DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                     $dql = "SELECT cp.id , cp.nombre as nombreCp ,cp.emailId,emp.nombre,emp.nombre as nombreE,cp.telefono,cp.movil,cp.sector_mercado ,concat(concat('<input type=\"checkbox\" class=\"checkbox idclientepotencial\" id=\"',cp.id), '\">' as link FROM ERPAdminBundle:CrmClientePotencial cp  "
                        . "JOIN cp.crmEmpresaCliente emp "
                        . "WHERE upper(cp.nombre)  LIKE upper(:busqueda) OR upper(emp.nombre)  LIKE upper(:busqueda)"
                        . "ORDER BY cp.nombre DESC ";
                     
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT cp.id , cp.nombre as nombreCp ,cp.emailId,emp.nombre,emp.nombre as nombreE,cp.telefono,cp.movil,cp.sector_mercado ,concat(concat('<input type=\"checkbox\" class=\"checkbox idclientepotencial\" id=\"',cp.id), '\">' as link FROM ERPAdminBundle:CrmClientePotencial cp "
                    . "JOIN cp.crmEmpresaCliente emp "
                    . " ORDER BY cp.nombre  DESC ";
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
    * @Route("/attributes/insert/clientepotencial", name="insert_clientepotencial")
    */
    public function insertarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $entity = new CrmClientePotencial();
           
           $entity->setNombre($data[0]);
           $entity->setEmailId($data[1]);
           $entity->setSiguienteFechaContacto(new \DateTime($data[2]));
           $entity->setTelefono($data[3]);
           $entity->setMovil($data[4]);
           $entity->setFax($data[5]);
           $entity->setSitioWeb($data[6]);
           
           
           $id_estadoClientePotencial = $em->getRepository('ERPAdminBundle:CtlEstadoClientePotencial')->find($data[7]);
           
           $id_industria = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($data[8]);
           
           $id_referenciacliente = $em->getRepository('ERPAdminBundle:CtlReferenciaCliente')->find($data[9]);
           
           $id_territorio = $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($data[10]);
           
       
           $id_usuarioSiguienteContacto = $em->getRepository('ERPAdminBundle:CtlUsuario')->find($data[11]);
           $id_usuarioPropietario = $em->getRepository('ERPAdminBundle:CtlUsuario')->find($data[12]);
           
           $id_empresa = $em->getRepository('ERPAdminBundle:CrmEmpresaCliente')->find($data[13]);
       
           
           $var ="";
           if ($data[14]==0) {
               $var = "Ingreso Menor";
               
           }elseif ($data[14]==1)
               {
                    $var = "Ingreso Medio";
               }
               else{
                   
                   $var = "Ingreso Superior";
               }
           
           $entity->setIndustriaCliente($id_industria);
           $entity->setEstadoClientePotencial($id_estadoClientePotencial);
           $entity->setReferenciaCliente($id_referenciacliente);
           $entity->setTerritorio($id_territorio);
           
           $entity->setIdUsuarioSiguienteContacto($id_usuarioSiguienteContacto);
           $entity->setIdUsuarioPropietario($id_usuarioPropietario);
           
           $entity->setCrmEmpresaCliente($id_empresa);
           $entity->setSectorMercado($var);
            
            
            
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
    * @Route("/attributes/edit/clientepotencial", name="edit_clientepotencial")
    */
    public function editarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $entity = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($data[0]);
           
           $entity->setNombre($data[1]);
           $entity->setEmailId($data[2]);
           $entity->setSiguienteFechaContacto(new \DateTime($data[3]));
           $entity->setTelefono($data[4]);
           $entity->setMovil($data[5]);
           $entity->setFax($data[6]);
           $entity->setSitioWeb($data[7]);
           
           
           $id_estadoClientePotencial = $em->getRepository('ERPAdminBundle:CtlEstadoClientePotencial')->find($data[8]);
           
           $id_industria = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($data[9]);
           
           $id_referenciacliente = $em->getRepository('ERPAdminBundle:CtlReferenciaCliente')->find($data[10]);
           
           $id_territorio = $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($data[11]);
           
       
           $id_usuarioSiguienteContacto = $em->getRepository('ERPAdminBundle:CtlUsuario')->find($data[12]);
           $id_usuarioPropietario = $em->getRepository('ERPAdminBundle:CtlUsuario')->find($data[13]);
           
           $id_empresa = $em->getRepository('ERPAdminBundle:CrmEmpresaCliente')->find($data[14]);
       
           
           $var ="";
           if ($data[14]==0) {
               $var = "Ingreso Menor";
               
           }elseif ($data[14]==1)
               {
                    $var = "Ingreso Medio";
               }
               else{
                   
                   $var = "Ingreso Superior";
               }
           
           $entity->setIndustriaCliente($id_industria);
           $entity->setEstadoClientePotencial($id_estadoClientePotencial);
           $entity->setReferenciaCliente($id_referenciacliente);
           $entity->setTerritorio($id_territorio);
           
           $entity->setIdUsuarioSiguienteContacto($id_usuarioSiguienteContacto);
           $entity->setIdUsuarioPropietario($id_usuarioPropietario);
           
           $entity->setCrmEmpresaCliente($id_empresa);
           $entity->setSectorMercado($var);
           
           
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
     * @Route("/admin/orders/delete/deletedetalle", name="delete_clientepotencial")
     */
    public function deleteClientePotencialAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        //var_dump($isAjax);
        $response = new JsonResponse();
        //if($isAjax){
            $idclientepotencial = $this->get('request')->request->get('idclientepotencial');
//           
            
            foreach($idclientepotencial as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->find($row);
                $em->remove($detalleOrden);
                $em->flush();
                
            }
   
            $response->setData(array(
                            'flag' => 0,
                            
                    ));    
            return $response; 
       
        
        
        
    }   
      
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
