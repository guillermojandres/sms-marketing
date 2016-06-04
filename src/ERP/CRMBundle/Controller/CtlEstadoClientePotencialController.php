<?php

namespace ERP\CRMBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlEstadoClientePotencial;
use ERP\AdminBundle\Form\CtlEstadoClientePotencialType;

/**
 * CtlEstadoClientePotencial controller.
 *
 * @Route("/admin/CRM/ctlestadoclientepotencial")
 */
class CtlEstadoClientePotencialController extends Controller
{
    /**
     * Lists all CtlEstadoClientePotencial entities.
     *
     * @Route("/", name="ctlestadoclientepotencial_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ctlEstadoClientePotencials = $em->getRepository('ERPAdminBundle:CtlEstadoClientePotencial')->findAll();
        
        $ctlEstadoClientePotencial = new CtlEstadoClientePotencial();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlEstadoClientePotencialType', $ctlEstadoClientePotencial);
        $form->handleRequest($request);
        

        return $this->render('ERPCRMBundle:ctlestadoclientepotencial/index.html.twig', array(
            'ctlEstadoClientePotencial' => $ctlEstadoClientePotencial,
            'ctlEstadoClientePotencials' => $ctlEstadoClientePotencials,
            'form' => $form->createView(),
        ));
    }
    
    

    /**
     * Creates a new CtlEstadoClientePotencial entity.
     *
     * @Route("/new", name="ctlestadoclientepotencial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlEstadoClientePotencial = new CtlEstadoClientePotencial();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlEstadoClientePotencialType', $ctlEstadoClientePotencial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $ctlEstadoClientePotencial->setEstado(1);
            
            $em->persist($ctlEstadoClientePotencial);
            $em->flush();
            return $this->redirectToRoute('ctlestadoclientepotencial_index', array('id' => $ctlEstadoClientePotencial->getId()));
        }


        return $this->render('ERPCRMBundle:ctlestadoclientepotencial/new.html.twig', array(
            'ctlEstadoClientePotencial' => $ctlEstadoClientePotencial,
            'form' => $form->createView(),
        ));
    }

    
    
    
    /**
     * Finds and displays a CtlEstadoClientePotencial entity.
     *
     * @Route("/{id}", name="admin_ctlestadoclientepotencial_show")
     * @Method("GET")
     */
    public function showAction(CtlEstadoClientePotencial $ctlEstadoClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($ctlEstadoClientePotencial);

        return $this->render('ctlestadoclientepotencial/show.html.twig', array(
            'ctlEstadoClientePotencial' => $ctlEstadoClientePotencial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlEstadoClientePotencial entity.
     *
     * @Route("/{id}/edit", name="ctlestadoclientepotencial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlEstadoClientePotencial $ctlEstadoClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($ctlEstadoClientePotencial);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlEstadoClientePotencialType', $ctlEstadoClientePotencial);
        $editForm->handleRequest($request);
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlEstadoClientePotencial);
            $em->flush();

            return $this->redirectToRoute('ctlestadoclientepotencial_index', array('id' => $ctlEstadoClientePotencial->getId()));
        }

        return $this->render('ERPCRMBundle:ctlestadoclientepotencial/edit.html.twig', array(
            'ctlEstadoClientePotencial' => $ctlEstadoClientePotencial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

//    /**
//     * Deletes a CtlEstadoClientePotencial entity.
//     *
//     * @Route("/{id}", name="admin_ctlestadoclientepotencial_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, CtlEstadoClientePotencial $ctlEstadoClientePotencial)
//    {
//        $form = $this->createDeleteForm($ctlEstadoClientePotencial);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($ctlEstadoClientePotencial);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('admin_ctlestadoclientepotencial_index');
//    }

    
    
    /**
     * Creates a form to delete a CtlEstadoClientePotencial entity.
     *
     * @param CtlEstadoClientePotencial $ctlEstadoClientePotencial The CtlEstadoClientePotencial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlEstadoClientePotencial $ctlEstadoClientePotencial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_ctlestadoclientepotencial_delete', array('id' => $ctlEstadoClientePotencial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * 
     *
     * @Route("/categoriacliente/data", name="estado_cliente_potencial_data")
     */
    public function dataEstadoClienteAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CtlEstadoClientePotencial();
        
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CtlEstadoClientePotencial')->findBy(array('estado'=>1));
        
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
        
                    $dql = "SELECT estadocp.id, estadocp.nombre  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idestadoclientepotencial\" id=\"',estadocp.id), '\">' as link FROM ERPAdminBundle:CtlEstadoClientePotencial estadocp "
                        . "WHERE upper(estadocp.nombre) LIKE upper(:busqueda) and estadocp.estado=1 "
                        . "ORDER BY estadocp.nombre DESC ";
                    
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                     $dql = "SELECT estadocp.id, estadocp.nombre  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idestadoclientepotencial\" id=\"',estadocp.id), '\">' as link FROM ERPAdminBundle:CtlEstadoClientePotencial estadocp "
                        . "WHERE upper(estadocp.nombre) LIKE upper(:busqueda) and estadocp.estado=1 "
                        . "ORDER BY estadocp.nombre DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT estadocp.id , estadocp.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idestadoclientepotencial\" id=\"',estadocp.id), '\">' as link FROM ERPAdminBundle:CtlEstadoClientePotencial estadocp "
                . " WHERE estadocp.estado=1 ORDER BY estadocp.nombre  DESC ";
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
     * @Route("/admin/CRM/configuracion/categoriacliente/eliminar", name="delete_estadoclientepotencial")
     */
    public function deleteCategoriaClienteAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
            $idcategoriacliente = $this->get('request')->request->get('idestadoclientepotencial');
//           
            
            foreach($idcategoriacliente as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CtlEstadoClientePotencial')->find($row);
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
