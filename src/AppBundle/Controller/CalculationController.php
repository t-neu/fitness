<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Calculation;
use AppBundle\Form\CalculationType;

/**
 * Calculation controller.
 *
 * @Route("/bmr")
 */
class CalculationController extends Controller
{
    /**
     * Lists all Calculation entities.
     *
     * @Route("/", name="bmr_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $calculations = $em->getRepository('AppBundle:Calculation')->findAll();
        
        /**
         * @var paginator |Knp|Component|Pager|Paginator
         */
        
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $calculations,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 3)    
        );
        
        return $this->render('calculation/index.html.twig', array(
            //'calculations' => $calculations,
            'calculations' => $result,
        ));
    }

    /**
     * Creates a new Calculation entity.
     *
     * @Route("/new", name="bmr_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $calculation = new Calculation();
        $form = $this->createForm('AppBundle\Form\CalculationType', $calculation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($calculation);
            $em->flush();

            return $this->redirectToRoute('bmr_show', array('id' => $calculation->getId()));
        }

        return $this->render('calculation/new.html.twig', array(
            'calculation' => $calculation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Calculation entity.
     *
     * @Route("/{id}", name="bmr_show")
     * @Method("GET")
     */
    public function showAction(Calculation $calculation)
    {
        $deleteForm = $this->createDeleteForm($calculation);

        return $this->render('calculation/show.html.twig', array(
            'calculation' => $calculation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Calculation entity.
     *
     * @Route("/{id}/edit", name="bmr_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Calculation $calculation)
    {
        $deleteForm = $this->createDeleteForm($calculation);
        $editForm = $this->createForm('AppBundle\Form\CalculationType', $calculation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($calculation);
            $em->flush();

            return $this->redirectToRoute('bmr_edit', array('id' => $calculation->getId()));
        }

        return $this->render('calculation/edit.html.twig', array(
            'calculation' => $calculation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Calculation entity.
     *
     * @Route("/{id}", name="bmr_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Calculation $calculation)
    {
        $form = $this->createDeleteForm($calculation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($calculation);
            $em->flush();
        }

        return $this->redirectToRoute('bmr_index');
    }

    /**
     * Creates a form to delete a Calculation entity.
     *
     * @param Calculation $calculation The Calculation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Calculation $calculation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bmr_delete', array('id' => $calculation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
