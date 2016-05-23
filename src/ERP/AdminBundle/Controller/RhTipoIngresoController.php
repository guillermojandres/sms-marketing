<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\RhTipoIngreso;
use ERP\AdminBundle\Form\RhTipoIngresoType;

/**
 * RhTipoIngreso controller.
 *
 * @Route("/rhtipoingreso")
 */
class RhTipoIngresoController extends Controller
{
    /**
     * Lists all RhTipoIngreso entities.
     *
     * @Route("/", name="rhtipoingreso_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rhTipoIngresos = $em->getRepository('ERPAdminBundle:RhTipoIngreso')->findAll();

        return $this->render('rhtipoingreso/index.html.twig', array(
            'rhTipoIngresos' => $rhTipoIngresos,
        ));
    }

    /**
     * Creates a new RhTipoIngreso entity.
     *
     * @Route("/new", name="rhtipoingreso_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rhTipoIngreso = new RhTipoIngreso();
        $form = $this->createForm('ERP\AdminBundle\Form\RhTipoIngresoType', $rhTipoIngreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhTipoIngreso);
            $em->flush();

            return $this->redirectToRoute('rhtipoingreso_show', array('id' => $rhTipoIngreso->getId()));
        }

        return $this->render('rhtipoingreso/new.html.twig', array(
            'rhTipoIngreso' => $rhTipoIngreso,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RhTipoIngreso entity.
     *
     * @Route("/{id}", name="rhtipoingreso_show")
     * @Method("GET")
     */
    public function showAction(RhTipoIngreso $rhTipoIngreso)
    {
        $deleteForm = $this->createDeleteForm($rhTipoIngreso);

        return $this->render('rhtipoingreso/show.html.twig', array(
            'rhTipoIngreso' => $rhTipoIngreso,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RhTipoIngreso entity.
     *
     * @Route("/{id}/edit", name="rhtipoingreso_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RhTipoIngreso $rhTipoIngreso)
    {
        $deleteForm = $this->createDeleteForm($rhTipoIngreso);
        $editForm = $this->createForm('ERP\AdminBundle\Form\RhTipoIngresoType', $rhTipoIngreso);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhTipoIngreso);
            $em->flush();

            return $this->redirectToRoute('rhtipoingreso_edit', array('id' => $rhTipoIngreso->getId()));
        }

        return $this->render('rhtipoingreso/edit.html.twig', array(
            'rhTipoIngreso' => $rhTipoIngreso,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RhTipoIngreso entity.
     *
     * @Route("/{id}", name="rhtipoingreso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RhTipoIngreso $rhTipoIngreso)
    {
        $form = $this->createDeleteForm($rhTipoIngreso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rhTipoIngreso);
            $em->flush();
        }

        return $this->redirectToRoute('rhtipoingreso_index');
    }

    /**
     * Creates a form to delete a RhTipoIngreso entity.
     *
     * @param RhTipoIngreso $rhTipoIngreso The RhTipoIngreso entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RhTipoIngreso $rhTipoIngreso)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rhtipoingreso_delete', array('id' => $rhTipoIngreso->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
