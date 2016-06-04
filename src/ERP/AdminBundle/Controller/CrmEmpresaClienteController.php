<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmEmpresaCliente;
use ERP\AdminBundle\Form\CrmEmpresaClienteType;

/**
 * CrmEmpresaCliente controller.
 *
 * @Route("/admin/empresacliente")
 */
class CrmEmpresaClienteController extends Controller
{
    /**
     * Lists all CrmEmpresaCliente entities.
     *
     * @Route("/", name="admin_empresacliente_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmEmpresaClientes = $em->getRepository('ERPAdminBundle:CrmEmpresaCliente')->findAll();

        return $this->render('crmempresacliente/index.html.twig', array(
            'crmEmpresaClientes' => $crmEmpresaClientes,
        ));
    }

    /**
     * Creates a new CrmEmpresaCliente entity.
     *
     * @Route("/new", name="admin_empresacliente_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmEmpresaCliente = new CrmEmpresaCliente();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmEmpresaClienteType', $crmEmpresaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmEmpresaCliente);
            $em->flush();

            return $this->redirectToRoute('admin_empresacliente_show', array('id' => $crmEmpresaCliente->getId()));
        }

        return $this->render('crmempresacliente/new.html.twig', array(
            'crmEmpresaCliente' => $crmEmpresaCliente,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CrmEmpresaCliente entity.
     *
     * @Route("/{id}", name="admin_empresacliente_show")
     * @Method("GET")
     */
    public function showAction(CrmEmpresaCliente $crmEmpresaCliente)
    {
        $deleteForm = $this->createDeleteForm($crmEmpresaCliente);

        return $this->render('crmempresacliente/show.html.twig', array(
            'crmEmpresaCliente' => $crmEmpresaCliente,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CrmEmpresaCliente entity.
     *
     * @Route("/{id}/edit", name="admin_empresacliente_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmEmpresaCliente $crmEmpresaCliente)
    {
        $deleteForm = $this->createDeleteForm($crmEmpresaCliente);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CrmEmpresaClienteType', $crmEmpresaCliente);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmEmpresaCliente);
            $em->flush();

            return $this->redirectToRoute('admin_empresacliente_edit', array('id' => $crmEmpresaCliente->getId()));
        }

        return $this->render('crmempresacliente/edit.html.twig', array(
            'crmEmpresaCliente' => $crmEmpresaCliente,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CrmEmpresaCliente entity.
     *
     * @Route("/{id}", name="admin_empresacliente_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmEmpresaCliente $crmEmpresaCliente)
    {
        $form = $this->createDeleteForm($crmEmpresaCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmEmpresaCliente);
            $em->flush();
        }

        return $this->redirectToRoute('admin_empresacliente_index');
    }

    /**
     * Creates a form to delete a CrmEmpresaCliente entity.
     *
     * @param CrmEmpresaCliente $crmEmpresaCliente The CrmEmpresaCliente entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmEmpresaCliente $crmEmpresaCliente)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_empresacliente_delete', array('id' => $crmEmpresaCliente->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
