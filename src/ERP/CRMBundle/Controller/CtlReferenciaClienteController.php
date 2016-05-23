<?php

namespace ERP\CRMBundle\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlReferenciaCliente;
use ERP\AdminBundle\Form\CtlReferenciaClienteType;

/**
 * CtlReferenciaCliente controller.
 *
 * @Route("/admin/CRM/referenciacliente")
 */
class CtlReferenciaClienteController extends Controller
{
    /**
     * Lists all CtlReferenciaCliente entities.
     *
     * @Route("/", name="referenciacliente_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ctlReferenciaClientes = $em->getRepository('ERPAdminBundle:CtlReferenciaCliente')->findAll();
        
        $ctlReferenciaCliente = new CtlReferenciaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlReferenciaClienteType', $ctlReferenciaCliente);
        $form->handleRequest($request);
        

        return $this->render('ERPCRMBundle:ctlreferenciacliente/index.html.twig', array(
            'ctlReferenciaCliente' => $ctlReferenciaCliente,
            'ctlReferenciaClientes' => $ctlReferenciaClientes,
            'form' => $form->createView(),
            
        ));
    }

    /**
     * Creates a new CtlReferenciaCliente entity.
     *
     * @Route("/new", name="referenciacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlReferenciaCliente = new CtlReferenciaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlReferenciaClienteType', $ctlReferenciaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $ctlReferenciaCliente->setEstado(1);
            
            $em->persist($ctlReferenciaCliente);
            $em->flush();

            return $this->redirectToRoute('referenciacliente_index', array('id' => $ctlReferenciaCliente->getId()));
        }

        return $this->render('ERPCRMBundle:ctlreferenciacliente/new.html.twig', array(
            'ctlReferenciaCliente' => $ctlReferenciaCliente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlReferenciaCliente entity.
     *
     * @Route("/{id}", name="admin_referenciacliente_show")
     * @Method("GET")
     */
    public function showAction(CtlReferenciaCliente $ctlReferenciaCliente)
    {
        $deleteForm = $this->createDeleteForm($ctlReferenciaCliente);

        return $this->render('ctlreferenciacliente/show.html.twig', array(
            'ctlReferenciaCliente' => $ctlReferenciaCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlReferenciaCliente entity.
     *
     * @Route("/{id}/edit", name="referenciacliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlReferenciaCliente $ctlReferenciaCliente)
    {
        $deleteForm = $this->createDeleteForm($ctlReferenciaCliente);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlReferenciaClienteType', $ctlReferenciaCliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlReferenciaCliente);
            $em->flush();

            return $this->redirectToRoute('referenciacliente_index', array('id' => $ctlReferenciaCliente->getId()));
        }

        return $this->render('ERPCRMBundle:ctlreferenciacliente/edit.html.twig', array(
            'ctlReferenciaCliente' => $ctlReferenciaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

//    /**
//     * Deletes a CtlReferenciaCliente entity.
//     *
//     * @Route("/{id}", name="admin_referenciacliente_delete")
//     * @Method("DELETE")
//     */
//    public function deleteAction(Request $request, CtlReferenciaCliente $ctlReferenciaCliente)
//    {
//        $form = $this->createDeleteForm($ctlReferenciaCliente);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($ctlReferenciaCliente);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('admin_referenciacliente_index');
//    }

    /**
     * Creates a form to delete a CtlReferenciaCliente entity.
     *
     * @param CtlReferenciaCliente $ctlReferenciaCliente The CtlReferenciaCliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlReferenciaCliente $ctlReferenciaCliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_referenciacliente_delete', array('id' => $ctlReferenciaCliente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    
    
    
      /**
     * 
     *
     * @Route("/industria/data", name="referencia_cliente_data")
     */
    public function dataReferenciaClienteAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CtlReferenciaCliente();
     
         
        $start = $request->query->get('start');
        $draw = $request->query->get('draw');
        $longitud = $request->query->get('length');
        $busqueda = $request->query->get('search');
        
        $em = $this->getDoctrine()->getEntityManager();
        $territoriosTotal = $em->getRepository('ERPAdminBundle:CtlReferenciaCliente')->findBy(array('estado'=>1));
        
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
        
                    $dql = "SELECT ref.id, ref.nombre  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idreferencia\" id=\"',ref.id), '\">' as link FROM ERPAdminBundle:CtlReferenciaCliente ref "
                        . "WHERE upper(ref.nombre) LIKE upper(:busqueda) and ref.estado=1 "
                        . "ORDER BY ref.nombre DESC ";
                    //Aqui estas trabjando
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                  $dql = "SELECT ref.id, ref.nombre  ,concat(concat('<input type=\"checkbox\" class=\"checkbox idreferencia\" id=\"',ref.id), '\">' as link FROM ERPAdminBundle:CtlReferenciaCliente ref "
                        . "WHERE upper(ref.nombre) LIKE upper(:busqueda) and ref.estado=1 "
                        . "ORDER BY ref.nombre DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT ref.id , ref.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idreferencia\" id=\"',ref.id), '\">' as link FROM ERPAdminBundle:CtlReferenciaCliente ref "
                . " WHERE ref.estado=1 ORDER BY ref.nombre  DESC ";
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
     * @Route("/admin/CRM/configuracion/industria/eliminar", name="delete_referenciacliente")
     */
    public function deleteIndustriaAction()
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        $response = new JsonResponse();
            $id_industria = $this->get('request')->request->get('idreferenciacliente');
//           
            
            foreach($id_industria as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CtlReferenciaCliente')->find($row);
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
