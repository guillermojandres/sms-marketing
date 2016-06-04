<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlIndustriaCliente;
use ERP\AdminBundle\Form\CtlIndustriaClienteType;

/**
 * CtlIndustriaCliente controller.
 *
 * @Route("/admin/industriacliente")
 */
class CtlIndustriaClienteController extends Controller
{
    /**
     * Lists all CtlIndustriaCliente entities.
     *
     * @Route("/", name="admin_industriacliente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ctlIndustriaClientes = $em->getRepository('ERPAdminBundle:CtlIndustriaCliente')->findAll();

        return $this->render('ctlindustriacliente/index.html.twig', array(
            'ctlIndustriaClientes' => $ctlIndustriaClientes,
        ));
    }

    /**
     * Creates a new CtlIndustriaCliente entity.
     *
     * @Route("/new", name="admin_industriacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlIndustriaCliente = new CtlIndustriaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlIndustriaClienteType', $ctlIndustriaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlIndustriaCliente);
            $em->flush();

            return $this->redirectToRoute('admin_industriacliente_show', array('id' => $ctlIndustriaCliente->getId()));
        }

        return $this->render('ctlindustriacliente/new.html.twig', array(
            'ctlIndustriaCliente' => $ctlIndustriaCliente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlIndustriaCliente entity.
     *
     * @Route("/{id}", name="admin_industriacliente_show")
     * @Method("GET")
     */
    public function showAction(CtlIndustriaCliente $ctlIndustriaCliente)
    {
        $deleteForm = $this->createDeleteForm($ctlIndustriaCliente);

        return $this->render('ctlindustriacliente/show.html.twig', array(
            'ctlIndustriaCliente' => $ctlIndustriaCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlIndustriaCliente entity.
     *
     * @Route("/{id}/edit", name="admin_industriacliente_edit")
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

            return $this->redirectToRoute('admin_industriacliente_edit', array('id' => $ctlIndustriaCliente->getId()));
        }

        return $this->render('ctlindustriacliente/edit.html.twig', array(
            'ctlIndustriaCliente' => $ctlIndustriaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlIndustriaCliente entity.
     *
     * @Route("/{id}", name="admin_industriacliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlIndustriaCliente $ctlIndustriaCliente)
    {
        $form = $this->createDeleteForm($ctlIndustriaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlIndustriaCliente);
            $em->flush();
        }

        return $this->redirectToRoute('admin_industriacliente_index');
    }

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
}
