<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlIndustriaCliente;
use ERP\AdminBundle\Form\CtlIndustriaClienteType;

/**
 * CtlIndustriaCliente controller.
 *
 * @Route("/admin/CRM/industria")
 */
class CtlIndustriaClienteController extends Controller
{
    /**
     * Lists all CtlIndustriaCliente entities.
     *
     * @Route("/", name="industriacliente_index")
     * @Method("GET")
     */
    
    public function indexAction(Request $request )
    {
        $em = $this->getDoctrine()->getManager();
        $ctlIndustriaClientes = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->findAll();
        
        //Esta parte es la que se agrega para poder mandar a llamar dentro de la vista un formulario
        
        $ctlIndustriaCliente = new CtlIndustriaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlIndustriaClienteType', $ctlIndustriaCliente);
        $form->handleRequest($request);
        

        return $this->render('ERPCRMBundle:ctlindustriacliente/index.html.twig', array(
            'ctlIndustriaCliente' => $ctlIndustriaCliente,//Este es parte de lo que se manda a llamar dentro de la vista para poder ocupar el formulario externo
            'ctlIndustriaClientes' => $ctlIndustriaClientes,
            'form' => $form->createView(),//Este es parte de lo que se manda a llamar dentro de la vista para poder ocupar el formulario externo
        ));
        
        
    }

    /**
     * Creates a new CtlIndustriaCliente entity.
     *
     * @Route("/new", name="industriacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlIndustriaCliente = new CtlIndustriaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlIndustriaClienteType', $ctlIndustriaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //Seccion donde se setea el estado ya que fue un campo que se agrego despues del mapeo de la base de datos
            $ctlIndustriaCliente->setEstado(1);
            
            $em->persist($ctlIndustriaCliente);
            $em->flush();

            return $this->redirectToRoute('industriacliente_index', array('id' => $ctlIndustriaCliente->getId()));
        }

        return $this->render('ERPCRMBundle:ctlindustriacliente/new.html.twig', array(
            'ctlIndustriaCliente' => $ctlIndustriaCliente,
            'form' => $form->createView(),
        ));
    }
    
    
    

    /**
     * Finds and displays a CtlIndustriaCliente entity.
     *
     * @Route("/{id}", name="industriacliente_show")
     * @Method("GET")
     */
    public function showAction(CtlIndustriaCliente $ctlIndustriaCliente)
    {
        $deleteForm = $this->createDeleteForm($ctlIndustriaCliente);

        return $this->render('ERPCRMBundle:ctlindustriacliente/show.html.twig', array(
            'ctlIndustriaCliente' => $ctlIndustriaCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    
    
    
    

    /**
     * Displays a form to edit an existing CtlIndustriaCliente entity.
     *
     * @Route("/{id}/edit", name="industria_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlIndustriaCliente $ctlIndustriaCliente)
    {
        $deleteForm = $this->createDeleteForm($ctlIndustriaCliente);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlIndustriaClienteType', $ctlIndustriaCliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlIndustriaCliente);
            $em->flush();

           return $this->redirectToRoute('industriacliente_index', array('id' => $ctlIndustriaCliente->getId()) );
        }

        return $this->render('ERPCRMBundle:ctlindustriacliente/edit.html.twig', array(
            'ctlIndustriaCliente' => $ctlIndustriaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    
    
//    /**
//     * Deletes a CtlIndustriaCliente entity.
//     *
//     * @Route("/{id}", name="admin_industriacliente_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, CtlIndustriaCliente $ctlIndustriaCliente)
//    {
//        $form = $this->createDeleteForm($ctlIndustriaCliente);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($ctlIndustriaCliente);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('admin_industriacliente_index');
//    }
//
    
    /**
     * Creates a form to delete a CtlIndustriaCliente entity.
     *
     * @param CtlIndustriaCliente $ctlIndustriaCliente The CtlIndustriaCliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    
    
    
    private function createDeleteForm(CtlIndustriaCliente $ctlIndustriaCliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_industriacliente_delete', array('id' => $ctlIndustriaCliente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    
  /**
     * 
     *
     * @Route("/industria/data", name="admin_industria_data")
     */
    public function dataterritorioAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CtlIndustriaCliente();
     
         
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->findBy(array('estado'=>1));
        
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
        
                    $dql = "SELECT ind.id, ind.descripcion  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idindustria\" id=\"',ind.id), '\">' as link FROM ERPAdminBundle:CtlIndustriaCliente ind "
                        . "WHERE upper(ind.descripcion) LIKE upper(:busqueda) and ind.estado=1 "
                        . "ORDER BY ind.descripcion DESC ";
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                   $dql = "SELECT ind.id, ind.descripcion ,concat(concat('<input type=\"checkbox\" class=\"checkbox idindustria\" id=\"',ind.id), '\">' as link FROM ERPAdminBundle:CtlIndustriaCliente ind "
                        . "WHERE upper(ind.descripcion) LIKE upper(:busqueda) and ind.estado=1 "
                        . "ORDER BY ind.descripcion DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT ind.id , ind.descripcion ,concat(concat('<input type=\"checkbox\" class=\"checkbox idindustria\" id=\"',ind.id), '\">' as link FROM ERPAdminBundle:CtlIndustriaCliente ind "
                . " WHERE ind.estado=1 ORDER BY ind.descripcion  DESC ";
            $territorio['data'] = $em->createQuery($dql)
                    ->setFirstResult($start)
                    ->setMaxResults($longitud)
                    ->getResult();
        }
     
        
        return new Response(json_encode($territorio));
    }
    
    
        
    /**
     * Displays a form to edit an existing Orden entity.
     *
     * @Route("/admin/CRM/configuracion/industria/eliminar", name="delete_industria")
     */
    public function deleteIndustriaAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
            $id_industria = $this->get('request')->request->get('id_industria');
//           
            
            foreach($id_industria as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($row);
                $detalleOrden->setEstado(0);
                $em->persist($detalleOrden);
                $em->flush();
                
            }
   
            $response->setData(array(
                            'flag' => 0,
                            
                    ));    
            return $response; 
       
        
        
        
    }
    
  /**
    * Ajax utilizado para buscar el precio del atributo seleccionado
    *  
    * @Route("/attributes/insert/clientepotencial", name="insert_industria")
    */
    public function insertarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $entity = new CtlIndustriaCliente();
           $entity->setDescripcion($data[0]);
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
    * @Route("/attributes/edit/cliente", name="edit_industria")
    */
    public function editarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            $entity = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->find($data[0]);
            $entity->setDescripcion($data[1]);
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
    
    
    
    
    
    
    
 
}
