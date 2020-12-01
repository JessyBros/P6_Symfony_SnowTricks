<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
    /**
     * @Route("/connexion", name="sign_in")
     */
    public function signIn()
    {
        return $this->render('security/sign_in.html.twig');
    }
}
