<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlTipoEmpleo;
use ERP\AdminBundle\Form\CtlTipoEmpleoType;

/**
 * CtlTipoEmpleo controller.
 *
 * @Route("/ctltipoempleo")
 */
class CtlTipoEmpleoController extends Controller
{
    /**
     * Lists all CtlTipoEmpleo entities.
     *
     * @Route("/", name="ctltipoempleo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ctlTipoEmpleos = $em->getRepository('ERPAdminBundle:CtlTipoEmpleo')->findAll();

        return $this->render('ctltipoempleo/index.html.twig', array(
            'ctlTipoEmpleos' => $ctlTipoEmpleos,
        ));
    }

    /**
     * Creates a new CtlTipoEmpleo entity.
     *
     * @Route("/new", name="ctltipoempleo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlTipoEmpleo = new CtlTipoEmpleo();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlTipoEmpleoType', $ctlTipoEmpleo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlTipoEmpleo);
            $em->flush();

            return $this->redirectToRoute('ctltipoempleo_show', array('id' => $ctlTipoEmpleo->getId()));
        }

        return $this->render('ctltipoempleo/new.html.twig', array(
            'ctlTipoEmpleo' => $ctlTipoEmpleo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlTipoEmpleo entity.
     *
     * @Route("/{id}", name="ctltipoempleo_show")
     * @Method("GET")
     */
    public function showAction(CtlTipoEmpleo $ctlTipoEmpleo)
    {
        $deleteForm = $this->createDeleteForm($ctlTipoEmpleo);

        return $this->render('ctltipoempleo/show.html.twig', array(
            'ctlTipoEmpleo' => $ctlTipoEmpleo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlTipoEmpleo entity.
     *
     * @Route("/{id}/edit", name="ctltipoempleo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlTipoEmpleo $ctlTipoEmpleo)
    {
        $deleteForm = $this->createDeleteForm($ctlTipoEmpleo);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlTipoEmpleoType', $ctlTipoEmpleo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlTipoEmpleo);
            $em->flush();

            return $this->redirectToRoute('ctltipoempleo_edit', array('id' => $ctlTipoEmpleo->getId()));
        }

        return $this->render('ctltipoempleo/edit.html.twig', array(
            'ctlTipoEmpleo' => $ctlTipoEmpleo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlTipoEmpleo entity.
     *
     * @Route("/{id}", name="ctltipoempleo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlTipoEmpleo $ctlTipoEmpleo)
    {
        $form = $this->createDeleteForm($ctlTipoEmpleo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlTipoEmpleo);
            $em->flush();
        }

        return $this->redirectToRoute('ctltipoempleo_index');
    }

    /**
     * Creates a form to delete a CtlTipoEmpleo entity.
     *
     * @param CtlTipoEmpleo $ctlTipoEmpleo The CtlTipoEmpleo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlTipoEmpleo $ctlTipoEmpleo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ctltipoempleo_delete', array('id' => $ctlTipoEmpleo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
