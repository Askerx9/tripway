<?php

namespace App\Controller;

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

}