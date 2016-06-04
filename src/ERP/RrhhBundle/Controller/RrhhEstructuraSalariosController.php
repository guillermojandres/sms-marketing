<?php
namespace ERP\RrhhBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use ERP\AdminBundle\Entity\RhEstructuraSalarios;
use ERP\AdminBundle\Entity\RhTipoDeduccion;
use ERP\AdminBundle\Entity\RhTipoIngreso;
use ERP\AdminBundle\Entity\RhSalario;
use ERP\AdminBundle\Entity\RhDeduccion;
use Symfony\Component\HttpFoundation\Response;
use ERP\AdminBundle\Form\RhPersonaType;


/**
 * RhEstructuraSalarios controller.
 * @Route("/rrhhestructurasalarios")
 */
class RrhhEstructuraSalariosController extends Controller{
    //put your code here
    
    /**
     * Lists all RhEstructuraSalarios entities.
     *
     * @Route("/", name="rhestructurasalarios_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rhEstructuraSalarios = $em->getRepository('ERPAdminBundle:RhEstructuraSalarios')->findAll();
/*
        return $this->render('rhestructurasalarios/index.html.twig', array(
            'rhEstructuraSalarios' => $rhEstructuraSalarios,
        ));*/
        
        $sql = "SELECT p.id AS id, p.nombres AS nombre FROM rh_persona p";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $ArrayPersona = $stm->fetchAll();
        
        return $this->render('ERPRrhhBundle:RrhhNominas:indexEstructuraSalario.html.twig', array(
                    'ArrayPersona' =>  $ArrayPersona,
                  
                        //  'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new RhEstructuraSalarios entity.
     *
     * @Route("/new", name="rrhhestructurasalarios_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rhEstructuraSalario = new RhEstructuraSalarios();
        $form = $this->createForm('ERP\AdminBundle\Form\RhEstructuraSalariosType', $rhEstructuraSalario);
        $form->handleRequest($request);


       $sql = "SELECT p.id AS id, concat(p.nombres,' ',p.apellido) AS nombre FROM rh_persona p";
        $stm = $this->container->get('database_connection')->prepare($sql);
        $stm->execute();
        $ArrayPersona = $stm->fetchAll();
        
        return $this->render('ERPRrhhBundle:RrhhNominas:newNominas.html.twig', array(
                    'ArrayPersona' =>  $ArrayPersona,
                  
                        //  'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RhEstructuraSalarios entity.
     *
     * @Route("/{id}", name="rhestructurasalarios_show")
     * @Method("GET")
     */
    public function showAction(RhEstructuraSalarios $rhEstructuraSalario)
    {
        $deleteForm = $this->createDeleteForm($rhEstructuraSalario);

        return $this->render('rhestructurasalarios/show.html.twig', array(
            'rhEstructuraSalario' => $rhEstructuraSalario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RhEstructuraSalarios entity.
     *
     * @Route("/{id}/edit", name="rhestructurasalarios_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RhEstructuraSalarios $rhEstructuraSalario)
    {
        $deleteForm = $this->createDeleteForm($rhEstructuraSalario);
        $editForm = $this->createForm('ERP\AdminBundle\Form\RhEstructuraSalariosType', $rhEstructuraSalario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhEstructuraSalario);
            $em->flush();

            return $this->redirectToRoute('rhestructurasalarios_edit', array('id' => $rhEstructuraSalario->getId()));
        }

        return $this->render('rhestructurasalarios/edit.html.twig', array(
            'rhEstructuraSalario' => $rhEstructuraSalario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RhEstructuraSalarios entity.
     *
     * @Route("/{id}", name="rhestructurasalarios_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RhEstructuraSalarios $rhEstructuraSalario)
    {
        $form = $this->createDeleteForm($rhEstructuraSalario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rhEstructuraSalario);
            $em->flush();
        }

        return $this->redirectToRoute('rhestructurasalarios_index');
    }

    /**
     * Creates a form to delete a RhEstructuraSalarios entity.
     *
     * @param RhEstructuraSalarios $rhEstructuraSalario The RhEstructuraSalarios entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RhEstructuraSalarios $rhEstructuraSalario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rhestructurasalarios_delete', array('id' => $rhEstructuraSalario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
     /**
     * @Route("/tipo_ingreso/get", name="tipo_ingreso", options={"expose"=true})
     * @Method("GET")
     */
    public function TipoIngresoAction() {

       
        try {

            $sqlExp = "Select i.id id, i.nombre_ingresocol nombre From rh_tipo_ingreso AS i";
            $stmExp = $this->container->get('database_connection')->prepare($sqlExp);
            $stmExp->execute();
            $data['ArrayTingreso'] = $stmExp->fetchAll();
        
            
             return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
             return new Response(json_encode($data)); 
            //echo $e->getMessage();   
        }
       
    }
    /**
     * @Route("/tipo_deduccion/get", name="tipo_deduccion", options={"expose"=true})
     * @Method("GET")
     */
    public function TipoDeduccionAction() {

       
        try {

            $sqlExp = "Select d.id id, d.nombre_deduccion nombre From rh_tipo_deduccion AS d";
            $stmExp = $this->container->get('database_connection')->prepare($sqlExp);
            $stmExp->execute();
            $data['ArrayDeduccion'] = $stmExp->fetchAll();
        
            
             return new Response(json_encode($data));
        } catch (\Exception $e) {
            $data['msj'] = "Falla al mostras datos";
             return new Response(json_encode($data)); 
            //echo $e->getMessage();   
        }
       
    }
    /**
     * @Route("/registrar_estructura/get", name="registrar_estructura", options={"expose"=true})
     * @Method("GET")
     */
    public function RegistrarDeduccionAction() {

       
        try {
              $em = $this->getDoctrine()->getManager();
              $request = $this->getRequest();
           $em->getConnection()->beginTransaction();
            $datosIngreso=$request->get('datosIngreso');
            $datosDeduccion=$request->get('datosDeduccion');
            
            
        
           $idEstructura = $this->getDoctrine()->getRepository('ERPAdminBundle:RhEstructuraSalarios')->findBy(array('rhPersona' => $request->get('persona')));
           $idPersona = $this->getDoctrine()->getRepository('ERPAdminBundle:RhPersona')->find($request->get('persona'));
          
            // Si el empleado ya existe
            if (!empty($idEstructura)) 
               {
               
            }
        else{
            $fecha ="2016/03/25";
            $EstructuraSalario = new RhEstructuraSalarios();
            $EstructuraSalario->setFechaInicio($fecha);
            $EstructuraSalario->setRhPersona($idPersona);
            $em->persist($EstructuraSalario);
            $em->flush();    
            
            $idEstructuraSalario = $this->getDoctrine()->getRepository('ERPAdminBundle:RhEstructuraSalarios')->find($EstructuraSalario->getId());
            foreach ($datosDeduccion as $objDeducion) 
                {
                    $Deduccion = new RhDeduccion();
                 
                   
                     $idDeduccion = $this->getDoctrine()->getRepository('ERPAdminBundle:RhTipoDeduccion')->find(intval($objDeducion['1']));
                        $Deduccion->setRhTipoDeduccion($idDeduccion);
                        $Deduccion->setImporteDeduccion($objDeducion['2']);
                        $Deduccion->setRhEstructuraSalarios($idEstructuraSalario);
                       
                        $em->persist($Deduccion);
                        $em->flush();
                    }
                     foreach ($datosIngreso as $objIngreso) 
                {
                    $Ingreso = new RhSalario();
                  $idIngreso = $this->getDoctrine()->getRepository('ERPAdminBundle:RhTipoIngreso')->find(intval($objIngreso['1']));
                        $Ingreso->setRhTipoIngreso($idIngreso);
                        $Ingreso->setImporte($objIngreso['2']);
                        $Ingreso->setRhEstructuraSalarios($idEstructuraSalario);
                       
                        $em->persist($Ingreso);
                        $em->flush();
                    }
                    $em->getConnection()->commit();
            $em->close();
             $data['msj'] = "Registrado";
            }
             return new Response(json_encode($data));
            
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            $em->close();
            $data['msj'] = $e->getMessage();//"Falla al mostras datos";
             return new Response(json_encode($data)); 
            //echo $e->getMessage();   
        }
       
    }
}
