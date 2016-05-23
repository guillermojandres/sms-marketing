<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlEstadoClientePotencial;
use ERP\AdminBundle\Form\CtlEstadoClientePotencialType;

/**
 * CtlEstadoClientePotencial controller.
 *
 * @Route("/admin/ctlestadoclientepotencial")
 */
class CtlEstadoClientePotencialController extends Controller
{
    /**
     * Lists all CtlEstadoClientePotencial entities.
     *
     * @Route("/", name="admin_ctlestadoclientepotencial_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ctlEstadoClientePotencials = $em->getRepository('ERPAdminBundle:CtlEstadoClientePotencial')->findAll();

        return $this->render('ctlestadoclientepotencial/index.html.twig', array(
            'ctlEstadoClientePotencials' => $ctlEstadoClientePotencials,
        ));
    }

    /**
     * Creates a new CtlEstadoClientePotencial entity.
     *
     * @Route("/new", name="admin_ctlestadoclientepotencial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlEstadoClientePotencial = new CtlEstadoClientePotencial();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlEstadoClientePotencialType', $ctlEstadoClientePotencial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlEstadoClientePotencial);
            $em->flush();

            return $this->redirectToRoute('admin_ctlestadoclientepotencial_show', array('id' => $ctlEstadoClientePotencial->getId()));
        }

        return $this->render('ctlestadoclientepotencial/new.html.twig', array(
            'ctlEstadoClientePotencial' => $ctlEstadoClientePotencial,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlEstadoClientePotencial entity.
     *
     * @Route("/{id}", name="admin_ctlestadoclientepotencial_show")
     * @Method("GET")
     */
    public function showAction(CtlEstadoClientePotencial $ctlEstadoClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($ctlEstadoClientePotencial);

        return $this->render('ctlestadoclientepotencial/show.html.twig', array(
            'ctlEstadoClientePotencial' => $ctlEstadoClientePotencial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlEstadoClientePotencial entity.
     *
     * @Route("/{id}/edit", name="admin_ctlestadoclientepotencial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlEstadoClientePotencial $ctlEstadoClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($ctlEstadoClientePotencial);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlEstadoClientePotencialType', $ctlEstadoClientePotencial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlEstadoClientePotencial);
            $em->flush();

            return $this->redirectToRoute('admin_ctlestadoclientepotencial_edit', array('id' => $ctlEstadoClientePotencial->getId()));
        }

        return $this->render('ctlestadoclientepotencial/edit.html.twig', array(
            'ctlEstadoClientePotencial' => $ctlEstadoClientePotencial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlEstadoClientePotencial entity.
     *
     * @Route("/{id}", name="admin_ctlestadoclientepotencial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlEstadoClientePotencial $ctlEstadoClientePotencial)
    {
        $form = $this->createDeleteForm($ctlEstadoClientePotencial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlEstadoClientePotencial);
            $em->flush();
        }

        return $this->redirectToRoute('admin_ctlestadoclientepotencial_index');
    }

    /**
     * Creates a form to delete a CtlEstadoClientePotencial entity.
     *
     * @param CtlEstadoClientePotencial $ctlEstadoClientePotencial The CtlEstadoClientePotencial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlEstadoClientePotencial $ctlEstadoClientePotencial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_ctlestadoclientepotencial_delete', array('id' => $ctlEstadoClientePotencial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
