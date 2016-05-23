<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CtlDepartamentoEmpresa;
use ERP\AdminBundle\Form\CtlDepartamentoEmpresaType;

/**
 * CtlDepartamentoEmpresa controller.
 *
 * @Route("/ctldepartamentoempresa")
 */
class CtlDepartamentoEmpresaController extends Controller
{
    /**
     * Lists all CtlDepartamentoEmpresa entities.
     *
     * @Route("/", name="ctldepartamentoempresa_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ctlDepartamentoEmpresas = $em->getRepository('ERPAdminBundle:CtlDepartamentoEmpresa')->findAll();

        return $this->render('ctldepartamentoempresa/index.html.twig', array(
            'ctlDepartamentoEmpresas' => $ctlDepartamentoEmpresas,
        ));
    }

    /**
     * Creates a new CtlDepartamentoEmpresa entity.
     *
     * @Route("/new", name="ctldepartamentoempresa_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ctlDepartamentoEmpresa = new CtlDepartamentoEmpresa();
        $form = $this->createForm('ERP\AdminBundle\Form\CtlDepartamentoEmpresaType', $ctlDepartamentoEmpresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlDepartamentoEmpresa);
            $em->flush();

            return $this->redirectToRoute('ctldepartamentoempresa_show', array('id' => $ctlDepartamentoEmpresa->getId()));
        }

        return $this->render('ctldepartamentoempresa/new.html.twig', array(
            'ctlDepartamentoEmpresa' => $ctlDepartamentoEmpresa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CtlDepartamentoEmpresa entity.
     *
     * @Route("/{id}", name="ctldepartamentoempresa_show")
     * @Method("GET")
     */
    public function showAction(CtlDepartamentoEmpresa $ctlDepartamentoEmpresa)
    {
        $deleteForm = $this->createDeleteForm($ctlDepartamentoEmpresa);

        return $this->render('ctldepartamentoempresa/show.html.twig', array(
            'ctlDepartamentoEmpresa' => $ctlDepartamentoEmpresa,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CtlDepartamentoEmpresa entity.
     *
     * @Route("/{id}/edit", name="ctldepartamentoempresa_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CtlDepartamentoEmpresa $ctlDepartamentoEmpresa)
    {
        $deleteForm = $this->createDeleteForm($ctlDepartamentoEmpresa);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CtlDepartamentoEmpresaType', $ctlDepartamentoEmpresa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctlDepartamentoEmpresa);
            $em->flush();

            return $this->redirectToRoute('ctldepartamentoempresa_edit', array('id' => $ctlDepartamentoEmpresa->getId()));
        }

        return $this->render('ctldepartamentoempresa/edit.html.twig', array(
            'ctlDepartamentoEmpresa' => $ctlDepartamentoEmpresa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CtlDepartamentoEmpresa entity.
     *
     * @Route("/{id}", name="ctldepartamentoempresa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CtlDepartamentoEmpresa $ctlDepartamentoEmpresa)
    {
        $form = $this->createDeleteForm($ctlDepartamentoEmpresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ctlDepartamentoEmpresa);
            $em->flush();
        }

        return $this->redirectToRoute('ctldepartamentoempresa_index');
    }

    /**
     * Creates a form to delete a CtlDepartamentoEmpresa entity.
     *
     * @param CtlDepartamentoEmpresa $ctlDepartamentoEmpresa The CtlDepartamentoEmpresa entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CtlDepartamentoEmpresa $ctlDepartamentoEmpresa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ctldepartamentoempresa_delete', array('id' => $ctlDepartamentoEmpresa->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
