<?php

namespace ERP\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\RhPersona;
use ERP\AdminBundle\Form\RhPersonaType;

/**
 * RhPersona controller.
 *
 * @Route("/rhpersona")
 */
class RhPersonaController extends Controller
{
    /**
     * Lists all RhPersona entities.
     *
     * @Route("/", name="rhpersona_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $rhPersonas = $em->getRepository('ERPAdminBundle:RhPersona')->findAll();

        return $this->render('rhpersona/index.html.twig', array(
            'rhPersonas' => $rhPersonas,
        ));
    }
    
    

    /**
     * Creates a new RhPersona entity.
     *
     * @Route("/new", name="rhpersona_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rhPersona = new RhPersona();
        $form = $this->createForm('ERP\AdminBundle\Form\RhPersonaType', $rhPersona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhPersona);
            $em->flush();

            return $this->redirectToRoute('rhpersona_show', array('id' => $rhPersona->getId()));
        }

        return $this->render('rhpersona/new.html.twig', array(
            'rhPersona' => $rhPersona,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RhPersona entity.
     *
     * @Route("/{id}", name="rhpersona_show")
     * @Method("GET")
     */
    public function showAction(RhPersona $rhPersona)
    {
        $deleteForm = $this->createDeleteForm($rhPersona);

        return $this->render('rhpersona/show.html.twig', array(
            'rhPersona' => $rhPersona,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RhPersona entity.
     *
     * @Route("/{id}/edit", name="rhpersona_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RhPersona $rhPersona)
    {
        $deleteForm = $this->createDeleteForm($rhPersona);
        $editForm = $this->createForm('ERP\AdminBundle\Form\RhPersonaType', $rhPersona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rhPersona);
            $em->flush();

            return $this->redirectToRoute('rhpersona_edit', array('id' => $rhPersona->getId()));
        }

        return $this->render('rhpersona/edit.html.twig', array(
            'rhPersona' => $rhPersona,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RhPersona entity.
     *
     * @Route("/{id}", name="rhpersona_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RhPersona $rhPersona)
    {
        $form = $this->createDeleteForm($rhPersona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rhPersona);
            $em->flush();
        }

        return $this->redirectToRoute('rhpersona_index');
    }

    /**
     * Creates a form to delete a RhPersona entity.
     *
     * @param RhPersona $rhPersona The RhPersona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RhPersona $rhPersona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rhpersona_delete', array('id' => $rhPersona->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
