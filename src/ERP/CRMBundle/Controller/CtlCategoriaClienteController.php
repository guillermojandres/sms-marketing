<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlCategoriaCliente;
use ERP\AdminBundle\Form\CtlCategoriaClienteType;

/**
 * CtlCategoriaCliente controller.
 *
 * @Route("/admin/CRM/categoriacliente")
 */
class CtlCategoriaClienteController extends Controller
{
    
    
    /**
     * Lists all CtlCategoriaCliente entities.
     *
     * @Route("/", name="categoriacliente_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ctlCategoriaClientes = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->findAll();
        
        $ctlCategoriaCliente = new CtlCategoriaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlCategoriaClienteType', $ctlCategoriaCliente);
        $form->handleRequest($request);

        return $this->render('ERPCRMBundle:ctlcategoriacliente/index.html.twig', array(
            'ctlCategoriaCliente' => $ctlCategoriaCliente,
            'ctlCategoriaClientes' => $ctlCategoriaClientes,
            'form' => $form->createView(),
            
        ));
    }
    
    

    /**
     * Creates a new CtlCategoriaCliente entity.
     *
     * @Route("/new", name="categoriacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlCategoriaCliente = new CtlCategoriaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlCategoriaClienteType', $ctlCategoriaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ctlCategoriaCliente->setEstado(1);
            
             $em->persist($ctlCategoriaCliente);
             $em->flush();

            return $this->redirectToRoute('categoriacliente_index', array('id' => $ctlCategoriaCliente->getId()));
        }

        return $this->render('ERPCRMBundle:ctlcategoriacliente/new.html.twig', array(
            'ctlCategoriaCliente' => $ctlCategoriaCliente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlCategoriaCliente entity.
     *
     * @Route("/{id}", name="admin_categoriacliente_show")
     * @Method("GET")
     */
    public function showAction(CtlCategoriaCliente $ctlCategoriaCliente)
    {
        $deleteForm = $this->createDeleteForm($ctlCategoriaCliente);

        return $this->render('ctlcategoriacliente/show.html.twig', array(
            'ctlCategoriaCliente' => $ctlCategoriaCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlCategoriaCliente entity.
     *
     * @Route("/{id}/edit", name="categoriacliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlCategoriaCliente $ctlCategoriaCliente)
    {
        $deleteForm = $this->createDeleteForm($ctlCategoriaCliente);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlCategoriaClienteType', $ctlCategoriaCliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlCategoriaCliente);
            $em->flush();

            return $this->redirectToRoute('categoriacliente_index', array('id' => $ctlCategoriaCliente->getId()));
        }

        return $this->render('ERPCRMBundle:ctlcategoriacliente/edit.html.twig', array(
            'ctlCategoriaCliente' => $ctlCategoriaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

//    /**
//     * Deletes a CtlCategoriaCliente entity.
//     *
//     * @Route("/{id}", name="admin_categoriacliente_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, CtlCategoriaCliente $ctlCategoriaCliente)
//    {
//        $form = $this->createDeleteForm($ctlCategoriaCliente);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($ctlCategoriaCliente);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('admin_categoriacliente_index');
//    }

    
    
    
    /**
     * Creates a form to delete a CtlCategoriaCliente entity.
     *
     * @param CtlCategoriaCliente $ctlCategoriaCliente The CtlCategoriaCliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlCategoriaCliente $ctlCategoriaCliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_categoriacliente_delete', array('id' => $ctlCategoriaCliente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    
    
    
 /**
     * 
     *
     * @Route("/categoriacliente/data", name="categoria_cliente_data")
     */
    public function datacategoriaclienteAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CtlCategoriaCliente();
     
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->findBy(array('estado'=>1));
        
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
        
                    $dql = "SELECT cat.id, cat.nombre  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcategoriacliente\" id=\"',cat.id), '\">' as link FROM ERPAdminBundle:CtlCategoriaCliente cat "
                        . "WHERE upper(cat.nombre) LIKE upper(:busqueda) and cat.estado=1 "
                        . "ORDER BY cat.nombre DESC ";
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                     $dql = "SELECT cat.id, cat.nombre  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcategoriacliente\" id=\"',cat.id), '\">' as link FROM ERPAdminBundle:CtlCategoriaCliente cat "
                        . "WHERE upper(cat.nombre) LIKE upper(:busqueda) and cat.estado=1 "
                        . "ORDER BY cat.nombre DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT cat.id , cat.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idcategoriacliente\" id=\"',cat.id), '\">' as link FROM ERPAdminBundle:CtlCategoriaCliente cat "
                . " WHERE cat.estado=1 ORDER BY cat.nombre  DESC ";
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
     * @Route("/admin/CRM/configuracion/categoriacliente/eliminar", name="delete_categoriacliente")
     */
    public function deleteCategoriaClienteAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
            $idcategoriacliente = $this->get('request')->request->get('idcategoriacliente');
         
            
            foreach($idcategoriacliente as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->find($row);
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
