<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Figure;
use App\Entity\Illustration;
use App\Entity\Video;

class FigureController extends AbstractController
{
    /**
     * @Route("/figure/{id}", name="figure")
     */
    public function figure($id)
    {
        $repo = $this->getDoctrine()->getRepository(Figure::class);
        $figure = $repo->find($id);

        $repoIllustrations = $this->getDoctrine()->getRepository(Illustration::class);
        $figureIllustration = $repoIllustrations->findOneByFigure($id);
        $illustrations = $repoIllustrations->findByFigure($id);

        $repoVideos = $this->getDoctrine()->getRepository(Video::class);
        $videos = $repoVideos->findByFigure($id);

        return $this->render('figure/index.html.twig', [
            'figureIllustration' => $figureIllustration,
            'figure' => $figure,
            'illustrations' => $illustrations,
            'videos' => $videos
        ]);
    }
}
