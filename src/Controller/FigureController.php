<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Figure;

class FigureController extends AbstractController
{
    /**
     * @Route("/figure/{id}", name="figure")
     */
    public function figure($id)
    {
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $repo = $this->getDoctrine()->getRepository(Figure::class);
        $figure = $repo->find($id);
        return $this->render('figure/index.html.twig', [
            'figure' => $figure
        ]);
    }
}
