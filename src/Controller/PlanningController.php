<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PlanningController extends AbstractController
{

  /**
   * @Route("/discover", name="planning.index")
   * @return Response
   */
  public function index(): Response
  {
    return $this->render('pages/planning/discover.html.twig');
  }

  /**
   * @Route("/discover/{id}", name="planning.discover")
   * @return Response
   */
  public function planning(): Response
  {
    return $this->render('pages/planning/planning.html.twig');
  }
}