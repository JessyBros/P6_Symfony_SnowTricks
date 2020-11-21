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
                ->setUser($this->getDoctrine()->getRepository(User::class)->find(49));

            if ($illustrationFiles = $form->get('illustrations')) {

                foreach ($illustrationFiles as $illustrationFile) {

                    $fileData = $illustrationFile->get('path')->getData();
                    dump($fileData);
                    $filename = bin2hex(random_bytes(6)) . '.' . $fileData->guessExtension();

                    try {
                        $fileData->move($photoDir, $filename);
                    } catch (FileException $e) {
                    }

                    $illustration = new Illustration();
                    $illustration->setPath($filename);
                    $figure->addIllustration($illustration);

                }
            }

            $entityManager->persist($figure);

            $entityManager->flush();

           // return $this->redirectToRoute('figure', ['id' => $figure->getId()]);
        }
        
        return $this->render('add_figure/index.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
    }
}
