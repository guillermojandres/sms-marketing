<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\RhPuestoPerfil;
use ERP\AdminBundle\Form\RhPuestoPerfilType;

/**
 * RhPuestoPerfil controller.
 *
 * @Route("/rhpuestoperfil")
 */
class RhPuestoPerfilController extends Controller
{
    /**
     * Lists all RhPuestoPerfil entities.
     *
     * @Route("/", name="rhpuestoperfil_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rhPuestoPerfils = $em->getRepository('ERPAdminBundle:RhPuestoPerfil')->findAll();

        return $this->render('rhpuestoperfil/index.html.twig', array(
            'rhPuestoPerfils' => $rhPuestoPerfils,
        ));
    }

    /**
     * Creates a new RhPuestoPerfil entity.
     *
     * @Route("/new", name="rhpuestoperfil_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rhPuestoPerfil = new RhPuestoPerfil();
        $form = $this->createForm('ERP\AdminBundle\Form\RhPuestoPerfilType', $rhPuestoPerfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhPuestoPerfil);
            $em->flush();

            return $this->redirectToRoute('rhpuestoperfil_show', array('id' => $rhPuestoPerfil->getId()));
        }

        return $this->render('rhpuestoperfil/new.html.twig', array(
            'rhPuestoPerfil' => $rhPuestoPerfil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RhPuestoPerfil entity.
     *
     * @Route("/{id}", name="rhpuestoperfil_show")
     * @Method("GET")
     */
    public function showAction(RhPuestoPerfil $rhPuestoPerfil)
    {
        $deleteForm = $this->createDeleteForm($rhPuestoPerfil);

        return $this->render('rhpuestoperfil/show.html.twig', array(
            'rhPuestoPerfil' => $rhPuestoPerfil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RhPuestoPerfil entity.
     *
     * @Route("/{id}/edit", name="rhpuestoperfil_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RhPuestoPerfil $rhPuestoPerfil)
    {
        $deleteForm = $this->createDeleteForm($rhPuestoPerfil);
        $editForm = $this->createForm('ERP\AdminBundle\Form\RhPuestoPerfilType', $rhPuestoPerfil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhPuestoPerfil);
            $em->flush();

            return $this->redirectToRoute('rhpuestoperfil_edit', array('id' => $rhPuestoPerfil->getId()));
        }

        return $this->render('rhpuestoperfil/edit.html.twig', array(
            'rhPuestoPerfil' => $rhPuestoPerfil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RhPuestoPerfil entity.
     *
     * @Route("/{id}", name="rhpuestoperfil_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RhPuestoPerfil $rhPuestoPerfil)
    {
        $form = $this->createDeleteForm($rhPuestoPerfil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rhPuestoPerfil);
            $em->flush();
        }

        return $this->redirectToRoute('rhpuestoperfil_index');
    }

    /**
     * Creates a form to delete a RhPuestoPerfil entity.
     *
     * @param RhPuestoPerfil $rhPuestoPerfil The RhPuestoPerfil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RhPuestoPerfil $rhPuestoPerfil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rhpuestoperfil_delete', array('id' => $rhPuestoPerfil->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
