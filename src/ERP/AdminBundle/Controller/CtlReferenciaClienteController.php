<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlReferenciaCliente;
use ERP\AdminBundle\Form\CtlReferenciaClienteType;

/**
 * CtlReferenciaCliente controller.
 *
 * @Route("/admin/referenciacliente")
 */
class CtlReferenciaClienteController extends Controller
{
    /**
     * Lists all CtlReferenciaCliente entities.
     *
     * @Route("/", name="admin_referenciacliente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ctlReferenciaClientes = $em->getRepository('ERPAdminBundle:CtlReferenciaCliente')->findAll();

        return $this->render('ctlreferenciacliente/index.html.twig', array(
            'ctlReferenciaClientes' => $ctlReferenciaClientes,
        ));
    }

    /**
     * Creates a new CtlReferenciaCliente entity.
     *
     * @Route("/new", name="admin_referenciacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlReferenciaCliente = new CtlReferenciaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlReferenciaClienteType', $ctlReferenciaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlReferenciaCliente);
            $em->flush();

            return $this->redirectToRoute('admin_referenciacliente_show', array('id' => $ctlReferenciaCliente->getId()));
        }

        return $this->render('ctlreferenciacliente/new.html.twig', array(
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
     * @Route("/{id}/edit", name="admin_referenciacliente_edit")
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

            return $this->redirectToRoute('admin_referenciacliente_edit', array('id' => $ctlReferenciaCliente->getId()));
        }

        return $this->render('ctlreferenciacliente/edit.html.twig', array(
            'ctlReferenciaCliente' => $ctlReferenciaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlReferenciaCliente entity.
     *
     * @Route("/{id}", name="admin_referenciacliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlReferenciaCliente $ctlReferenciaCliente)
    {
        $form = $this->createDeleteForm($ctlReferenciaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlReferenciaCliente);
            $em->flush();
        }

        return $this->redirectToRoute('admin_referenciacliente_index');
    }

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
}
