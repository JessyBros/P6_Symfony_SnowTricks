<?php

namespace App\Controller;

use App\Entity\Figure;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $figure = $this->getDoctrine()->getRepository(Figure::class)->findAll();

        return $this->render('home.html.twig', [
            'figures' => $figure,
        ]);
    }
}
