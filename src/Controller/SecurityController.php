<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
   


    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authUtils
     * @return Response
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        
        if ($this->getUser()) {
            return $this->redirectToRoute('dashboard');
       }
        
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
       
       
    }


    /**
     * @Route("/login", name="login")
     */
   /* public function login(AuthenticationUtils $authenticationUtils): Response
    {

       // die('Entra a usuario login');

        if ($this->getUser()) {
             return $this->redirectToRoute('dashboard');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }*/

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
       // return $this->render('security/login.html.twig', ['last_username' => null, 'error' => null]);
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


}
