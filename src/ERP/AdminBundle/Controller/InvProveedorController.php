<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\InvProveedor;
use ERP\AdminBundle\Form\InvProveedorType;

/**
 * InvProveedor controller.
 *
 * @Route("/admin/invproveedor")
 */
class InvProveedorController extends Controller
{
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/", name="admin_invproveedor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invProveedors = $em->getRepository('ERPAdminBundle:InvProveedor')->findAll();

        return $this->render('invproveedor/index.html.twig', array(
            'invProveedors' => $invProveedors,
        ));
    }

    /**
     * Creates a new InvProveedor entity.
     *
     * @Route("/new", name="admin_invproveedor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $invProveedor = new InvProveedor();
        $form = $this->createForm('ERP\AdminBundle\Form\InvProveedorType', $invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invProveedor);
            $em->flush();

            return $this->redirectToRoute('admin_invproveedor_show', array('id' => $invProveedor->getId()));
        }

        return $this->render('invproveedor/new.html.twig', array(
            'invProveedor' => $invProveedor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InvProveedor entity.
     *
     * @Route("/{id}", name="admin_invproveedor_show")
     * @Method("GET")
     */
    public function showAction(InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);

        return $this->render('invproveedor/show.html.twig', array(
            'invProveedor' => $invProveedor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing InvProveedor entity.
     *
     * @Route("/{id}/edit", name="admin_invproveedor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, InvProveedor $invProveedor)
    {
        $deleteForm = $this->createDeleteForm($invProveedor);
        $editForm = $this->createForm('ERP\AdminBundle\Form\InvProveedorType', $invProveedor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invProveedor);
            $em->flush();

            return $this->redirectToRoute('admin_invproveedor_edit', array('id' => $invProveedor->getId()));
        }

        return $this->render('invproveedor/edit.html.twig', array(
            'invProveedor' => $invProveedor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InvProveedor entity.
     *
     * @Route("/{id}", name="admin_invproveedor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, InvProveedor $invProveedor)
    {
        $form = $this->createDeleteForm($invProveedor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($invProveedor);
            $em->flush();
        }

        return $this->redirectToRoute('admin_invproveedor_index');
    }

    /**
     * Creates a form to delete a InvProveedor entity.
     *
     * @param InvProveedor $invProveedor The InvProveedor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InvProveedor $invProveedor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_invproveedor_delete', array('id' => $invProveedor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
