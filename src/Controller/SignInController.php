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
    public function index(): Response
    {
        return $this->render('sign_in/index.html.twig');
    }
}
