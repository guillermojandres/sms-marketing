<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlTerritorio;
use ERP\AdminBundle\Form\CtlTerritorioType;

/**
 * CtlTerritorio controller.
 *
 * @Route("/admin/CRM/configuracion/territorios")
 */
class CtlTerritorioController extends Controller
{
    /**
     * Lists all CtlTerritorio entities.
     *
     * @Route("/", name="ctlterritorio_index2")
     * @Method({"GET","POST"})
     */
     public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ctlTerritorios = $em->getRepository('ERPAdminBundle:CtlTerritorio')->findAll();
        $ctlTerritorio = new CtlTerritorio();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlTerritorioType', $ctlTerritorio);
        $form->handleRequest($request);

        
        
        return $this->render('ERPCRMBundle:ctlterritorio:index.html.twig', array(
            'ctlTerritorio' => $ctlTerritorio,
            'ctlTerritorios' => $ctlTerritorios,
            'form' => $form->createView(),
        ));
    }
    

    /**
     * Creates a new CtlTerritorio entity.
     *
     * @Route("/new", name="ctlterritorio_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlTerritorio = new CtlTerritorio();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlTerritorioType', $ctlTerritorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            //Aqui esta la parte donde seteo un valor que se agregado a la base de datos de mas
            $ctlTerritorio->setEstado(1);   
            
            $em->persist($ctlTerritorio);
            $em->flush();

            return $this->redirectToRoute('ctlterritorio_index2');
        }

        return $this->render('ERPCRMBundle:ctlterritorio/new.html.twig', array(
            'ctlTerritorio' => $ctlTerritorio,
            'form' => $form->createView(),
        ));
    }
    

    /**
     * Finds and displays a CtlTerritorio entity.
     *
     * @Route("/{id}", name="ctlterritorio_show")
     * @Method("GET")
     */
    public function showAction(CtlTerritorio $ctlTerritorio)
    {
        $deleteForm = $this->createDeleteForm($ctlTerritorio);

        return $this->render('ERPCRMBundle:ctlterritorio/show.html.twig', array(
            'ctlTerritorio' => $ctlTerritorio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlTerritorio entity.
     *
     * @Route("/{id}/edit", name="ctlterritorio_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlTerritorio $ctlTerritorio)
    {
        $deleteForm = $this->createDeleteForm($ctlTerritorio);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlTerritorioType', $ctlTerritorio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlTerritorio);
            $em->flush();

            return $this->redirectToRoute('ctlterritorio_index2' );
        }

        return $this->render('ERPCRMBundle:ctlterritorio/edit.html.twig', array(
            'ctlTerritorio'=> $ctlTerritorio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlTerritorio entity.
     *
     * @Route("/{id}", name="ctlterritorio_delete2")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlTerritorio $ctlTerritorio)
    {
        $form = $this->createDeleteForm($ctlTerritorio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlTerritorio);
            $em->flush();
        }

        return $this->redirectToRoute('ctlterritorio_index2');
    }

    /**
     * Creates a form to delete a CtlTerritorio entity.
     *
     * @param CtlTerritorio $ctlTerritorio The CtlTerritorio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlTerritorio $ctlTerritorio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ctlterritorio_delete', array('id' => $ctlTerritorio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
   
    
 
    
    /**
     * 
     *
     * @Route("/territoio/data", name="admin_territorio_data")
     */
    public function dataterritorioAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CtlTerritorio();
     
     
//	
        //echo $output;
	//return new Response(json_encode( $output ));
    //echo json_encode( $output );
//    return array(
//            //'entities' => $entities,
//            'pacientes' => $output['aaData'],
//            'entity' => $entity,
//            'form'   => $form->createView(),
//        );
//       // $persona = new Persona();
//        //var_dump($request);
//        $entity = new Paciente();    
//        var_dump($request);
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CtlTerritorio')->findBy(array('estado'=>1));
        
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
            //foreach ($arrayFiltro as $row){
                //var_dump($row);
              //  if($row!=''){
                    
                    $dql = "SELECT ter.id, ter.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',ter.id), '\">' as link FROM ERPAdminBundle:CtlTerritorio ter "
                        . "WHERE upper(ter.nombre) LIKE upper(:busqueda) and ter.estado=1 "
                        . "ORDER BY ter.nombre DESC ";
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                   $dql = "SELECT ter.id, ter.nombre,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',ter.id), '\">' as link FROM ERPAdminBundle:CtlTerritorio ter "
                        . "WHERE upper(ter.nombre) LIKE upper(:busqueda) and ter.estado=1 "
                        . "ORDER BY ter.nombre DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT ter.id , ter.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',ter.id), '\">' as link FROM ERPAdminBundle:CtlTerritorio ter "
                . " WHERE ter.estado=1 ORDER BY ter.nombre DESC ";
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
     * @Route("/admin/orders/delete/deletedetalle", name="delete_territorio")
     */
    public function deleteTerritorioAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        //var_dump($isAjax);
        $response = new JsonResponse();
        //if($isAjax){
            $id_territorio = $this->get('request')->request->get('id_territorio');
//            $ordenId = $this->get('request')->request->get('ordenId');
            //var_dump($id_territorio);
            
            foreach($id_territorio as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($row);
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
    * @Route("/attributes/insert/clientepotencial", name="insert_territorio")
    */
    public function insertarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            
           $entity = new CtlTerritorio();
           $entity->setNombre($data[0]);
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
    * @Route("/attributes/edit/cliente", name="edit_territorio")
    */
    public function editarDatos(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
        if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            $entity = $em->getRepository('ERPAdminBundle:CtlTerritorio')->find($data[0]);
            $entity->setNombre($data[1]);
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
