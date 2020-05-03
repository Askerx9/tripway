<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class UserController extends AbstractController
{
    /**
     * @Route("/profil", name="profil.index")
     * @return Response
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('pages/profil/index.html.twig', ['user' => $user]);
    }

}