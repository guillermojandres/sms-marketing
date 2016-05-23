<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmCliente;
use ERP\AdminBundle\Form\CrmClienteType;

/**
 * CrmCliente controller.
 *
 * @Route("/admin/cliente")
 */
class CrmClienteController extends Controller
{
    /**
     * Lists all CrmCliente entities.
     *
     * @Route("/", name="admin_cliente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmClientes = $em->getRepository('ERPAdminBundle:CrmCliente')->findAll();

        return $this->render('crmcliente/index.html.twig', array(
            'crmClientes' => $crmClientes,
        ));
    }

    /**
     * Creates a new CrmCliente entity.
     *
     * @Route("/new", name="admin_cliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmCliente = new CrmCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClienteType', $crmCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmCliente);
            $em->flush();

            return $this->redirectToRoute('admin_cliente_show', array('id' => $crmCliente->getId()));
        }

        return $this->render('crmcliente/new.html.twig', array(
            'crmCliente' => $crmCliente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CrmCliente entity.
     *
     * @Route("/{id}", name="admin_cliente_show")
     * @Method("GET")
     */
    public function showAction(CrmCliente $crmCliente)
    {
        $deleteForm = $this->createDeleteForm($crmCliente);

        return $this->render('crmcliente/show.html.twig', array(
            'crmCliente' => $crmCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CrmCliente entity.
     *
     * @Route("/{id}/edit", name="admin_cliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmCliente $crmCliente)
    {
        $deleteForm = $this->createDeleteForm($crmCliente);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CrmClienteType', $crmCliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmCliente);
            $em->flush();

            return $this->redirectToRoute('admin_cliente_edit', array('id' => $crmCliente->getId()));
        }

        return $this->render('crmcliente/edit.html.twig', array(
            'crmCliente' => $crmCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CrmCliente entity.
     *
     * @Route("/{id}", name="admin_cliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmCliente $crmCliente)
    {
        $form = $this->createDeleteForm($crmCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmCliente);
            $em->flush();
        }

        return $this->redirectToRoute('admin_cliente_index');
    }

    /**
     * Creates a form to delete a CrmCliente entity.
     *
     * @param CrmCliente $crmCliente The CrmCliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmCliente $crmCliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_cliente_delete', array('id' => $crmCliente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
