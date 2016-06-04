<?php

namespace ERP\InventarioBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\InvProducto;
use ERP\AdminBundle\Entity\InvProductoTransaccion;
use ERP\AdminBundle\Entity\InvFotoProducto;
use ERP\AdminBundle\Form\InvProductoType;



/**
 * InvProducto controller.
 *
 * @Route("/admin/InventarioBundle/invproducto")
 */
class InvProductoController extends Controller
{
    /**
     * Lists all InvProducto entities.
     *
     * @Route("/", name="invproducto_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $invProducto = new InvProducto(); //Es para poder poner el ingreso
        $form = $this->createForm('ERP\AdminBundle\Form\InvProductoType', $invProducto); //Es para poder poner el ingreso
        $form->handleRequest($request); //Es para poder poner el ingreso
        
        $invproducto = $em->getRepository('ERPAdminBundle:InvProducto')->findAll();
        return $this->render('ERPInventarioBundle:invproducto:index.html.twig', array(
            'invproducto' => $invproducto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new InvProducto entity.
     *
     * @Route("/new", name="invproducto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlInvProducto = new ctlInvProducto();
        $form = $this->createForm('ERP\AdminBundle\Form\InvProductoType', $ctlInvProducto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $ctlInvProducto->setEstado('1');
            $em->persist($ctlInvProducto);
            $em->flush();
            
//            return $this->redirectToRoute('ctltipoinventario_index', array('id' => $ctlTipoInventario->getId()));
            return $this->redirectToRoute('ctltipoinventario_index');
        }

        return $this->render('ERPInventarioBundle:invproducto:index.html.twig', array(
            'ctlInvProducto' => $ctlInvProducto,
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
        $entity = new InvProducto();
     
     
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
        $territoriosTotal = $em->getRepository('ERPAdminBundle:InvProducto')->findBy(array('estado'=>1));
        
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
                    
                    $dql = "SELECT tin.id, tin.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',tin.id), '\">' as link FROM ERPAdminBundle:InvProducto tin "
                        . "WHERE upper(tin.nombre) LIKE upper(:busqueda) and tin.estado=1 "
                        . "ORDER BY tin.nombre DESC ";
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->getResult();
                    
                   $territorio['recordsFiltered']= count($territorio['data']);
                    
                   $dql = "SELECT tin.id, tin.nombre,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',tin.id), '\">' as link FROM ERPAdminBundle:InvProducto tin "
                        . "WHERE upper(tin.nombre) LIKE upper(:busqueda) and tin.estado=1 "
                        . "ORDER BY tin.nombre DESC ";
                   
                   $territorio['data'] = $em->createQuery($dql)
                            ->setParameters(array('busqueda'=>"%".$busqueda['value']."%"))
                            ->setFirstResult($start)
                            ->setMaxResults($longitud)
                            ->getResult();
       
        }
        else{
            $dql = "SELECT tin.id , tin.nombre ,concat(concat('<input type=\"checkbox\" class=\"checkbox idterritorio\" id=\"',tin.id), '\">' as link FROM ERPAdminBundle:InvProducto tin "
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
                $detalleOrden = $em->getRepository('ERPAdminBundle:InvProducto')->find($row);
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
    * Ajax utilizado para insertar el formulario
    *  
    * @Route("/insert/form/product", name="insert_form_product")
    */
     public function createProductoAction(Request $request)
    {
       
        $isAjax = $this->get('Request')->isXMLhttpRequest();
        
        //if($isAjax){
            $em = $this->getDoctrine()->getManager();    
            $data = $request->request->get('request');
            //var_dump($data);
            //die();
            
           $entity = new InvProducto();
           $fotoprod = new InvFotoProducto();
         
           $entity->setFecha(new \DateTime("now"));
           $entity->setNombre($data[0]);
           $entity->setDescripcion($data[1]);
           $entity->setPrecioCompra($data[2]);
           $entity->setPrecioVenta($data[3]);
           $entity->setSku($data[4]);
           $entity->setSerial($data[5]);
           $entity->setInventarioBajo($data[6]);
           $entity->setTotalExistencia($data[7]);
           $zona = $em->getRepository('ERPAdminBundle:InvZona')->find($data[10]);
           
           $entity->setInvZona($zona);
           $catprod = $em->getRepository('ERPAdminBundle:CltCatProducto')->find($data[8]);
           $entity->setInvCatProducto($catprod);
           $tipoinv = $em->getRepository('ERPAdminBundle:CtlTipoInventario')->find($data[9]);
           $entity->setInvTipoInventario($tipoinv);  
           $entity->setEstado(1);
           
           
           
           
           $em->persist($entity);
           $em->flush();
           
           $prod_trans = new InvProductoTransaccion();
           $prod_trans->setFecha(new \DateTime("now"));
           $prod_trans->setCantidad($data[7]);
           $prod_trans->setTipoTransaccion(1);
           $prod_trans->setInvProducto($entity);
           
           $em->persist($prod_trans);
           $em->flush();
           
           
           $fotoprod->setNombre($data[11]); //nombre de la foto

           if ($fotoprod->getNombre() != null){
               
                $path = $this->container->getParameter('photo.producto');

                $fecha = date('Y-m-d His');
                
                $extension = $fotoprod->getFile()->getClientOriginalExtension();
                $nombreArchivo = $fotoprod->getId() . "-" . $fecha . "." . $extension;
                
                $em->persist($fotoprod);
                $em->flush();
                //var_dump($path.$nombreArchivo);

                $fotoprod->setNombre($nombreArchivo);// setFile
                $fotoprod->getFile()->move($path, $nombreArchivo);
                $em->persist($fotoprod);
                $em->flush();
            }
           
           $response = new JsonResponse();
           $response->setData(array(
                           'flag' => 1
                    ));

            return $response;
        //} else {    
        //    return new Response('0');              
        //}  
    }
    
    
}
//******************//
