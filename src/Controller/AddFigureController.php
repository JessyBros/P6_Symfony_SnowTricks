<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Illustration;
use App\Entity\User;
use App\Entity\Video;
use App\Form\FigureFormType;
use App\Service\SaveIllustration;
use App\Service\SaveRegexVideo;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AddFigureController extends AbstractController
{
    /**
     * @Route("/ajouter-une-figure", name="add_figure")
     * @IsGranted("ROLE_USER", statusCode=403)
     */
    public function addFigure(EntityManagerInterface $entityManager, Request $request, SaveRegexVideo $saveRegexVideo, SaveIllustration $saveIllustration)
    {
        $figure = new Figure();
        $video = new Video();

        $form = $this->createForm(FigureFormType::class, $figure);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $figure->setName($form->get('name')->getData())
                    ->setUser($this->getUser());

            // Enregistre les illustrations antant que l'utilisateur en crée et stocks les images associés
            if ($illustrations = $form->get('illustrations')) {
                foreach ($illustrations as $illustration) {
                    if ($illustration->getData() != null){
                        $uploadedFile = $illustration->get('file')->getData();
                        $saveIllustration->save($illustration->getData(), $uploadedFile);
                    }
                }
            }

            // Enregistre les vidéos antant que l'utilisateur en crée et stocks les images associés
            if ($videos = $form->get('videos')) {
                foreach ($videos as $video) {
                    $saveRegexVideo->save($video);
                }
            }

            $entityManager->persist($figure);
            $entityManager->flush();
            $this->addFlash('success', 'Votre article a bien été crée !');
            return $this->redirectToRoute('figure', ['slug' => $figure->getSlug()]);
        }

        return $this->render('figure/add_figure.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
    }
}