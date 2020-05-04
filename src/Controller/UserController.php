<?php


namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class UserController extends AbstractController
{
    /**
     * @Route("/profil", name="profile.index")
     * @return Response
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('pages/profile/index.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/signin", name="profile.create")
     * @return Response
     */
    public function create(): Response
    {
        $user = new User();
        $form = $this->createFormBuilder($user)
                    ->add('firstname')
                    ->add('lastname')
                    ->add('email')
                    ->add('password')
                    ->add('opt_in')
                    ->getForm();

        return $this->render('pages/profile/create.html.twig', [
            'formUser' => $form->createView()
        ]);
    }


}