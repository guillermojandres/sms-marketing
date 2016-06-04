<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\RhTipoDeduccion;
use ERP\AdminBundle\Form\RhTipoDeduccionType;

/**
 * RhTipoDeduccion controller.
 *
 * @Route("/rhtipodeduccion")
 */
class RhTipoDeduccionController extends Controller
{
    /**
     * Lists all RhTipoDeduccion entities.
     *
     * @Route("/", name="rhtipodeduccion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rhTipoDeduccions = $em->getRepository('ERPAdminBundle:RhTipoDeduccion')->findAll();

        return $this->render('rhtipodeduccion/index.html.twig', array(
            'rhTipoDeduccions' => $rhTipoDeduccions,
        ));
    }

    /**
     * Creates a new RhTipoDeduccion entity.
     *
     * @Route("/new", name="rhtipodeduccion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rhTipoDeduccion = new RhTipoDeduccion();
        $form = $this->createForm('ERP\AdminBundle\Form\RhTipoDeduccionType', $rhTipoDeduccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhTipoDeduccion);
            $em->flush();

            return $this->redirectToRoute('rhtipodeduccion_show', array('id' => $rhTipoDeduccion->getId()));
        }

        return $this->render('rhtipodeduccion/new.html.twig', array(
            'rhTipoDeduccion' => $rhTipoDeduccion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RhTipoDeduccion entity.
     *
     * @Route("/{id}", name="rhtipodeduccion_show")
     * @Method("GET")
     */
    public function showAction(RhTipoDeduccion $rhTipoDeduccion)
    {
        $deleteForm = $this->createDeleteForm($rhTipoDeduccion);

        return $this->render('rhtipodeduccion/show.html.twig', array(
            'rhTipoDeduccion' => $rhTipoDeduccion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RhTipoDeduccion entity.
     *
     * @Route("/{id}/edit", name="rhtipodeduccion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RhTipoDeduccion $rhTipoDeduccion)
    {
        $deleteForm = $this->createDeleteForm($rhTipoDeduccion);
        $editForm = $this->createForm('ERP\AdminBundle\Form\RhTipoDeduccionType', $rhTipoDeduccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhTipoDeduccion);
            $em->flush();

            return $this->redirectToRoute('rhtipodeduccion_edit', array('id' => $rhTipoDeduccion->getId()));
        }

        return $this->render('rhtipodeduccion/edit.html.twig', array(
            'rhTipoDeduccion' => $rhTipoDeduccion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RhTipoDeduccion entity.
     *
     * @Route("/{id}", name="rhtipodeduccion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RhTipoDeduccion $rhTipoDeduccion)
    {
        $form = $this->createDeleteForm($rhTipoDeduccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rhTipoDeduccion);
            $em->flush();
        }

        return $this->redirectToRoute('rhtipodeduccion_index');
    }

    /**
     * Creates a form to delete a RhTipoDeduccion entity.
     *
     * @param RhTipoDeduccion $rhTipoDeduccion The RhTipoDeduccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RhTipoDeduccion $rhTipoDeduccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rhtipodeduccion_delete', array('id' => $rhTipoDeduccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
