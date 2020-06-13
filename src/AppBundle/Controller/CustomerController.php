<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Customer;

/**
 * Customer controller.
 *
 * @Route("customer")
 */
class CustomerController extends Controller {
  /**
   * Lists all customers
   *
   * @Route("/", name="customer_index")
   * @Method("GET")
   */
  public function indexAction(){
    $em = $this->getDoctrine()->getManager();

    $customers = $em->getRepository('AppBundle:Customer')->findAll();

    return $this->render('customer/index.html.twig', array(
      'customers' => $customers,
    ));
  }

  /**
   * Finds and displays a customer.
   *
   * @Route("/{id}/view", name="customer_show")
   * @Method("GET")
   */
  public function showAction(Customer $customer, Request $request){
    $deleteForm = $this->createDeleteForm($customer);
    
    return $this->render('customer/show.html.twig', array(
      'customer'    => $customer,
      'delete_form' => $deleteForm->createView(),
    ));
  }

   /**
   * Creates a new customer
   *
   * @Route("/new", name="customer_new")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request){
    $em = $this->getDoctrine()->getManager();

    $customer = new Customer();
    $form = $this->createForm('AppBundle\Form\CustomerType', $customer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em->persist($customer);
      $em->flush();

      $this->addFlash("success", $this->get('translator')->trans('message.customer.add.success'));

      return $this->redirectToRoute('customer_index');
    }

    return $this->render('customer/new.html.twig', array(
      'customer' => $customer,
      'form'     => $form->createView(),
    ));
  }

    /**
   * Displays a form to edit an existing customer.
   *
   * @Route("/{id}/edit", name="customer_edit")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, Customer $customer){
    $editForm = $this->createForm('AppBundle\Form\CustomerType', $customer);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $this->getDoctrine()->getManager()->flush();
      $this->addFlash("success", $this->get('translator')->trans('message.customer.edit.success')); 

      return $this->redirectToRoute('customer_index');   
    }

    return $this->render('customer/edit.html.twig', array(
      'customer' => $customer,
      'form'     => $editForm->createView(),
    ));
  }

  /**
   * Deletes a customer.
   *
   * @Route("/{id}/delete", name="customer_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, Customer $customer){
    $form = $this->createDeleteForm($customer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($customer);
      $em->flush();
    }
    
    $this->addFlash("success", $this->get('translator')->trans('message.customer.delete.success')); 
    
    return $this->redirectToRoute('customer_index');
  }

  /**
   * Creates a form to delete a customer.
   *
   * @param Customer $customer The customer entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Customer $customer){
    return $this->createFormBuilder()
      ->setAction($this->generateUrl('customer_delete', array('id' => $customer->getId())))
      ->setMethod('DELETE')
      ->getForm()
    ;
  }

  /**
   * Deletes a customer from confirm in index
   *
   * @Route("/confirm/delete", name="customer_delete_confirm")
   * @Method("POST")
   */
  public function deleteFromConfirmAction(Request $request){
    $em = $this->getDoctrine()->getManager();

    $idCustomer = (int)$request->query->get('id');    
    $customer = $em->getRepository('AppBundle:Customer')->findOneById($idCustomer);

    $em->remove($customer);
    $em->flush();

    return new Response('success');
  }

}