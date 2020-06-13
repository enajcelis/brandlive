<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Group controller.
 *
 * @Route("group")
 */
class GroupController extends Controller {

  /**
   * Lists all groups
   *
   * @Route("/", name="group_index")
   * @Method("GET")
   */
  public function indexAction(){
    $em = $this->getDoctrine()->getManager();

    $groups = $em->getRepository('AppBundle:Group')->findAll();

    return $this->render('group/index.html.twig', array(
      'groups' => $groups,
    ));
  }

}