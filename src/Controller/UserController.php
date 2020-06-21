<?php

namespace App\Controller;

use App\Repository\PlanningRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile_index")
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('pages/profile/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/profile/{slug}", name="profile_planning")
     * @return Response
     */
    public function planning(PlanningRepository $planningRepository, string $slug): Response
    {
        return $this->render('pages/profile/details.html.twig' , [
            'planning' => $planningRepository->findOneBySlug($slug),
        ]);
    }

}