<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlCategoriaCliente;
use ERP\AdminBundle\Form\CtlCategoriaClienteType;

/**
 * CtlCategoriaCliente controller.
 *
 * @Route("/admin/categoriacliente")
 */
class CtlCategoriaClienteController extends Controller
{
    /**
     * Lists all CtlCategoriaCliente entities.
     *
     * @Route("/", name="admin_categoriacliente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ctlCategoriaClientes = $em->getRepository('ERPAdminBundle:CtlCategoriaCliente')->findAll();

        return $this->render('ctlcategoriacliente/index.html.twig', array(
            'ctlCategoriaClientes' => $ctlCategoriaClientes,
        ));
    }

    /**
     * Creates a new CtlCategoriaCliente entity.
     *
     * @Route("/new", name="admin_categoriacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlCategoriaCliente = new CtlCategoriaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlCategoriaClienteType', $ctlCategoriaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlCategoriaCliente);
            $em->flush();

            return $this->redirectToRoute('admin_categoriacliente_show', array('id' => $ctlCategoriaCliente->getId()));
        }

        return $this->render('ctlcategoriacliente/new.html.twig', array(
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
     * @Route("/{id}/edit", name="admin_categoriacliente_edit")
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

            return $this->redirectToRoute('admin_categoriacliente_edit', array('id' => $ctlCategoriaCliente->getId()));
        }

        return $this->render('ctlcategoriacliente/edit.html.twig', array(
            'ctlCategoriaCliente' => $ctlCategoriaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlCategoriaCliente entity.
     *
     * @Route("/{id}", name="admin_categoriacliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlCategoriaCliente $ctlCategoriaCliente)
    {
        $form = $this->createDeleteForm($ctlCategoriaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlCategoriaCliente);
            $em->flush();
        }

        return $this->redirectToRoute('admin_categoriacliente_index');
    }

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
}
