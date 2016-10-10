<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\GymList;
use AppBundle\Form\GymListType;

/**
 * GymList controller.
 *
 * @Route("/gymlist")
 */
class GymListController extends Controller
{
    /**
     * Lists all GymList entities.
     *
     * @Route("/", name="gymlist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gymLists = $em->getRepository('AppBundle:GymList')->findAll();

        return $this->render('gymlist/index.html.twig', array(
            'gymLists' => $gymLists,
        ));
    }

    /**
     * Creates a new GymList entity.
     *
     * @Route("/new", name="gymlist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gymList = new GymList();
        $form = $this->createForm('AppBundle\Form\GymListType', $gymList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gymList);
            $em->flush();

            return $this->redirectToRoute('gymlist_show', array('id' => $gymList->getId()));
        }

        return $this->render('gymlist/new.html.twig', array(
            'gymList' => $gymList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a GymList entity.
     *
     * @Route("/{id}", name="gymlist_show")
     * @Method("GET")
     */
    public function showAction(GymList $gymList)
    {
        $deleteForm = $this->createDeleteForm($gymList);

        return $this->render('gymlist/show.html.twig', array(
            'gymList' => $gymList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing GymList entity.
     *
     * @Route("/{id}/edit", name="gymlist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GymList $gymList)
    {
        $deleteForm = $this->createDeleteForm($gymList);
        $editForm = $this->createForm('AppBundle\Form\GymListType', $gymList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gymList);
            $em->flush();

            return $this->redirectToRoute('gymlist_edit', array('id' => $gymList->getId()));
        }

        return $this->render('gymlist/edit.html.twig', array(
            'gymList' => $gymList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a GymList entity.
     *
     * @Route("/{id}", name="gymlist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GymList $gymList)
    {
        $form = $this->createDeleteForm($gymList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gymList);
            $em->flush();
        }

        return $this->redirectToRoute('gymlist_index');
    }

    /**
     * Creates a form to delete a GymList entity.
     *
     * @param GymList $gymList The GymList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GymList $gymList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gymlist_delete', array('id' => $gymList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
