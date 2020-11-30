<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Illustration;
use App\Entity\Video;
use App\Entity\User;
use App\Form\FigureFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;




class AddFigureController extends AbstractController
{
    /**
     * @Route("/ajouter-une-figure", name="add_figure")
     */
    public function addFigure(EntityManagerInterface $entityManager, Request $request, string $photoDir)
    {
        $figure = new Figure();
        $video = new Video();

        $form = $this->createForm(FigureFormType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $figure->setDate(new \DateTime())
                ->setUser($this->getUser());

            // Enregistre les illustrations antant que l'utilisateur en crée et stocks les images associés
            if ($illustrationFiles = $form->get('illustrations')) { // ne peut etre null
                foreach ($illustrationFiles as $illustrationFile) {
                    $fileData = $illustrationFile->get('file')->getData();
                    $filename = bin2hex(random_bytes(6)) . '.' . $fileData->guessExtension();
                    try {
                        $fileData->move($photoDir, $filename);
                    } catch (FileException $e) {
                    }
                    $illustrationFile->getData()->setPath($filename);
                }
            }

            // Enregistre les vidéos antant que l'utilisateur en crée et stocks les images associés
            if ($videos = $form->get('videos')) {
                foreach ($videos as $video) {
                    $url = $video->get('path')->getData();
                    $urlCut = explode("https://www.youtube.com/watch?v=", $url); // Supprime -> https://www.youtube.com/watch?v=
                    dump($urlCut);
                    $video->getData()->setPath($urlCut);
                }
            }

            $entityManager->persist($figure);
            $entityManager->flush();

           // return $this->redirectToRoute('figure', ['id' => $figure->getId()]);
        }

        return $this->render('figure/add_figure.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
    }
}
