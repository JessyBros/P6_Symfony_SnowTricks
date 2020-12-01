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
     * @Route("/modifier_la_figure/{id}", name="update_figure")
     */
    public function updateFigure(Figure $figure, EntityManagerInterface $entityManager, Request $request, string $photoDir)
    {
        $form = $this->createForm(FigureFormType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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

            $entityManager->persist($figure);
            $entityManager->flush();
        }

        return $this->render('figure/update_figure.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
    }
}
