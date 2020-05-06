<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, EntityManagerInterface $manager): Response
    {
//        dd($this->getUser());
         if ($this->getUser()) {

             $user = ($this->getUser())->setLastSignAt( new \DateTime() );

             $manager->persist($user);
             $manager->flush();

             return $this->redirectToRoute('profile_index');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/signup", name="app.registration")
     */
    public function registration (Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre compte a bien été créé!'
            );

            // TODO: Confirmation par mail

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/registration.html.twig', [
            'formUser' => $form->createView(),
            'errors' =>  $form->getErrors(true)
        ]);
    }

    /**
     * @Route("/logout", name="app.logout")
     */
    public function logout()
    {
//        TODO: Logout
//        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
