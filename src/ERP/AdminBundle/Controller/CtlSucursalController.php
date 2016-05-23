<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlSucursal;
use ERP\AdminBundle\Form\CtlSucursalType;

/**
 * CtlSucursal controller.
 *
 * @Route("/ctlsucursal")
 */
class CtlSucursalController extends Controller
{
    /**
     * Lists all CtlSucursal entities.
     *
     * @Route("/", name="ctlsucursal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ctlSucursals = $em->getRepository('ERPAdminBundle:CtlSucursal')->findAll();

        return $this->render('ctlsucursal/index.html.twig', array(
            'ctlSucursals' => $ctlSucursals,
        ));
    }

    /**
     * Creates a new CtlSucursal entity.
     *
     * @Route("/new", name="ctlsucursal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlSucursal = new CtlSucursal();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlSucursalType', $ctlSucursal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlSucursal);
            $em->flush();

            return $this->redirectToRoute('ctlsucursal_show', array('id' => $ctlSucursal->getId()));
        }

        return $this->render('ctlsucursal/new.html.twig', array(
            'ctlSucursal' => $ctlSucursal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlSucursal entity.
     *
     * @Route("/{id}", name="ctlsucursal_show")
     * @Method("GET")
     */
    public function showAction(CtlSucursal $ctlSucursal)
    {
        $deleteForm = $this->createDeleteForm($ctlSucursal);

        return $this->render('ctlsucursal/show.html.twig', array(
            'ctlSucursal' => $ctlSucursal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlSucursal entity.
     *
     * @Route("/{id}/edit", name="ctlsucursal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlSucursal $ctlSucursal)
    {
        $deleteForm = $this->createDeleteForm($ctlSucursal);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlSucursalType', $ctlSucursal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlSucursal);
            $em->flush();

            return $this->redirectToRoute('ctlsucursal_edit', array('id' => $ctlSucursal->getId()));
        }

        return $this->render('ctlsucursal/edit.html.twig', array(
            'ctlSucursal' => $ctlSucursal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlSucursal entity.
     *
     * @Route("/{id}", name="ctlsucursal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlSucursal $ctlSucursal)
    {
        $form = $this->createDeleteForm($ctlSucursal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlSucursal);
            $em->flush();
        }

        return $this->redirectToRoute('ctlsucursal_index');
    }

    /**
     * Creates a form to delete a CtlSucursal entity.
     *
     * @param CtlSucursal $ctlSucursal The CtlSucursal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlSucursal $ctlSucursal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ctlsucursal_delete', array('id' => $ctlSucursal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
