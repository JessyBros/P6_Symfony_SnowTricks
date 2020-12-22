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

class UpdateFigureController extends AbstractController
{
    /**
     * @Route("/modifier_la_figure/{slug}", name="update_figure")
     */
    public function updateFigure(Figure $figure, EntityManagerInterface $entityManager, Request $request, string $photoDir)
    {
        $form = $this->createForm(FigureFormType::class, $figure)->remove('name');
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

             // Enregistre les illustrations antant que l'utilisateur en crée et stocks les images associés
            if ($illustrationFiles = $form->get('illustrations')) {
                foreach ($illustrationFiles as $illustrationFile) {
                    if ($illustrationFile->get('file')->getData() != null) {
                        $fileData = $illustrationFile->get('file')->getData();
                        $filename = bin2hex(random_bytes(6)) . '.' . $fileData->guessExtension();
                        try {
                            $fileData->move($photoDir, $filename);
                        } catch (FileException $e) {
                            // nothing do
                        }
                        $illustrationFile->getData()->setPath($filename);
                    }
                }
            }

           // Enregistre les vidéos antant que l'utilisateur en crée et stocks les images associés
           if ($videos = $form->get('videos')) {
            foreach ($videos as $video) {
                $url = $video->get('path')->getData();
                if ($url != null) {
                    preg_match('#^https:\/\/www.youtube.com\/watch\?v=|^https:\/\/www.youtu.be/#', $url, $urlCut);
                    $urlValid = str_replace($urlCut,"",$url);
                    $video->getData()->setPath($urlValid);
                }
            }
        }
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été modifié !');

            return $this->redirectToRoute('figure', ['slug' => $figure->getSlug()]);
        }

        return $this->render('figure/update_figure.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
    }
}