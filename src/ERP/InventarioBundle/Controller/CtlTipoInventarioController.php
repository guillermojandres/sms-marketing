<?php

namespace ERP\InventarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlTipoInventario;
use ERP\AdminBundle\Form\CtlTipoInventarioType;

/**
 * CtlPais controller.
 *
 * @Route("/admin/InventarioBundle/ctltipoinventario")
 */
class CtlTipoInventarioController extends Controller
{
    /**
     * Lists all CtlTipoInventario entities.
     *
     * @Route("/", name="ctltipoinventario_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $ctlTipoInventario = new CtlTipoInventario(); //Es para poder poner el ingreso
        $form = $this->createForm('ERP\AdminBundle\Form\CtlTipoInventarioType', $ctlTipoInventario); //Es para poder poner el ingreso
        $form->handleRequest($request); //Es para poder poner el ingreso
        
        $ctltipoinventario = $em->getRepository('ERPAdminBundle:CtlTipoInventario')->findAll();
        return $this->render('ERPInventarioBundle:tipoinventario:index.html.twig', array(
            'ctltipoinventario' => $ctltipoinventario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new CtlTipoInventario entity.
     *
     * @Route("/new", name="ctltipoinventario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlTipoInventario = new CtlTipoInventario();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlTipoInventarioType', $ctlTipoInventario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ctlTipoInventario->setEstado('1');
            $em->persist($ctlTipoInventario);
            $em->flush();

//            return $this->redirectToRoute('ctltipoinventario_index', array('id' => $ctlTipoInventario->getId()));
            return $this->redirectToRoute('ctltipoinventario_index');
        }

        return $this->render('ERPInventarioBundle:tipoinventario:new.html.twig', array(
            'ctlTipoInventario' => $ctlTipoInventario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlTipoInventario entity.
     *
     * @Route("/{id}", name="ctltipoinventario_show")
     * @Method("GET")
     */
    public function showAction(CtlTipoInventario $CtlTipoInventario)
    {
        $deleteForm = $this->createDeleteForm($CtlTipoInventario);

        return $this->render('ctlpais/show.html.twig', array(
            '$CtlTipoInventario' => $CtlTipoInventario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlTipoInventario entity.
     *
     * @Route("/{id}/edit", name="ctltipoinventario_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlTipoInventario $CtlTipoInventario)
    {
        
        $deleteForm = $this->createDeleteForm($CtlTipoInventario);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlTipoInventarioType', $CtlTipoInventario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($CtlTipoInventario);
            $em->flush();

//            return $this->redirectToRoute('ctltipoinventario_edit', array('id' => $CtlTipoInventario->getId()));
            return $this->redirectToRoute('ctltipoinventario_index', array('id' => $CtlTipoInventario->getId()));
        }

        return $this->render('ERPInventarioBundle:tipoinventario/edit.html.twig', array(
            'CtlTipoInventario' => $CtlTipoInventario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlPais entity.
     *
     * @Route("/{id}", name="ctltipoinventario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlTipoInventario $CtlTipoInventario)
    {
        $form = $this->createDeleteForm($CtlTipoInventario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($CtlTipoInventario);
            $em->flush();
        }

        return $this->redirectToRoute('ctltipoinventario_index');
    }

    /**
     * Creates a form to delete a CtlPais entity.
     *
     * @param CtlTipoInventario $CtlTipoInventario The CtlPais entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlTipoInventario $CtlTipoInventario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ctlpais_delete', array('id' => $CtlTipoInventario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
    /**
     * 
     *
     * @Route("/tipoinventario/data", name="admin_tipoinventario_data")
     */
    public function dataterritorioAction(Request $request)
    {
        
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
        $entity = new CtlTipoInventario();
     
     
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
                    
                    $dql = "SELECT tin.id, tin.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',tin.id), '\">' as link FROM ERPAdminBundle:CtlTipoInventario tin "
                        . "WHERE upper(tin.nombre) LIKE upper(:busqueda) and tin.estado=1 "
                        . "ORDER BY tin.nombre DESC ";
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                   $dql = "SELECT tin.id, tin.nombre,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',tin.id), '\">' as link FROM ERPAdminBundle:CtlTipoInventario tin "
                        . "WHERE upper(tin.nombre) LIKE upper(:busqueda) and tin.estado=1 "
                        . "ORDER BY tin.nombre DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT tin.id , tin.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',tin.id), '\">' as link FROM ERPAdminBundle:CtlTipoInventario tin "
                . " WHERE tin.estado=1 ORDER BY tin.nombre DESC ";
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
     * @Route("/admin/orders/delete/deletetipoinventario", name="delete_ctltipoinventario")
     */
    public function deleteTerritorioAction(Request $request)
    {
        
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        //var_dump($isAjax);
        $response = new JsonResponse();
        //if($isAjax){
            //$id_territorio = $this->get('request')->request->get('id_territorio');
            $id_territorio = $request->request->get('id_territorio');
//            $ordenId = $this->get('request')->request->get('ordenId');
            
            
            foreach($id_territorio as $row){
                $em = $this->getDoctrine()->getManager();
                $detalleOrden = $em->getRepository('ERPAdminBundle:CtlTipoInventario')->find($row);
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
