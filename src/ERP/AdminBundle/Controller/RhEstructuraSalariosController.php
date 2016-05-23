<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\RhEstructuraSalarios;
use ERP\AdminBundle\Form\RhEstructuraSalariosType;

/**
 * RhEstructuraSalarios controller.
 *
 * @Route("/rhestructurasalarios")
 */
class RhEstructuraSalariosController extends Controller
{
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

        return $this->render('rhestructurasalarios/index.html.twig', array(
            'rhEstructuraSalarios' => $rhEstructuraSalarios,
        ));
    }

    /**
     * Creates a new RhEstructuraSalarios entity.
     *
     * @Route("/new", name="rhestructurasalarios_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rhEstructuraSalario = new RhEstructuraSalarios();
        $form = $this->createForm('ERP\AdminBundle\Form\RhEstructuraSalariosType', $rhEstructuraSalario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhEstructuraSalario);
            $em->flush();

            return $this->redirectToRoute('rhestructurasalarios_show', array('id' => $rhEstructuraSalario->getId()));
        }

        return $this->render('rhestructurasalarios/new.html.twig', array(
            'rhEstructuraSalario' => $rhEstructuraSalario,
            'form' => $form->createView(),
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
}
