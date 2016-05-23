<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\CrmClientePotencial;
use ERP\AdminBundle\Form\CrmClientePotencialType;

/**
 * CrmClientePotencial controller.
 *
 * @Route("/admin/clientepotencial")
 */
class CrmClientePotencialController extends Controller
{
    /**
     * Lists all CrmClientePotencial entities.
     *
     * @Route("/", name="admin_clientepotencial_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmClientePotencials = $em->getRepository('ERPAdminBundle:CrmClientePotencial')->findAll();

        return $this->render('crmclientepotencial/index.html.twig', array(
            'crmClientePotencials' => $crmClientePotencials,
        ));
    }

    /**
     * Creates a new CrmClientePotencial entity.
     *
     * @Route("/new", name="admin_clientepotencial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmClientePotencial = new CrmClientePotencial();
        $form = $this->createForm('ERP\AdminBundle\Form\CrmClientePotencialType', $crmClientePotencial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmClientePotencial);
            $em->flush();

            return $this->redirectToRoute('admin_clientepotencial_show', array('id' => $crmClientePotencial->getId()));
        }

        return $this->render('crmclientepotencial/new.html.twig', array(
            'crmClientePotencial' => $crmClientePotencial,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CrmClientePotencial entity.
     *
     * @Route("/{id}", name="admin_clientepotencial_show")
     * @Method("GET")
     */
    public function showAction(CrmClientePotencial $crmClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($crmClientePotencial);

        return $this->render('crmclientepotencial/show.html.twig', array(
            'crmClientePotencial' => $crmClientePotencial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CrmClientePotencial entity.
     *
     * @Route("/{id}/edit", name="admin_clientepotencial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmClientePotencial $crmClientePotencial)
    {
        $deleteForm = $this->createDeleteForm($crmClientePotencial);
        $editForm = $this->createForm('ERP\AdminBundle\Form\CrmClientePotencialType', $crmClientePotencial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($crmClientePotencial);
            $em->flush();

            return $this->redirectToRoute('admin_clientepotencial_edit', array('id' => $crmClientePotencial->getId()));
        }

        return $this->render('crmclientepotencial/edit.html.twig', array(
            'crmClientePotencial' => $crmClientePotencial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CrmClientePotencial entity.
     *
     * @Route("/{id}", name="admin_clientepotencial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmClientePotencial $crmClientePotencial)
    {
        $form = $this->createDeleteForm($crmClientePotencial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmClientePotencial);
            $em->flush();
        }

        return $this->redirectToRoute('admin_clientepotencial_index');
    }

    /**
     * Creates a form to delete a CrmClientePotencial entity.
     *
     * @param CrmClientePotencial $crmClientePotencial The CrmClientePotencial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmClientePotencial $crmClientePotencial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_clientepotencial_delete', array('id' => $crmClientePotencial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
