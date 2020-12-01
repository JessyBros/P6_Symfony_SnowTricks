<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogOutController extends AbstractController
{
    /**
     * @Route("/deconnexion", name="log_out")
     */
    public function logOut(){}
}
