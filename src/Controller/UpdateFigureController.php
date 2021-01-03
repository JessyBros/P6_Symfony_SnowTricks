<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Illustration;
use App\Entity\Video;
use App\Entity\User;
use App\Entity\Comment;
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

class UpdateFigureController extends AbstractController
{
    /**
     * @Route("/modifier-la-figure/{slug}", name="update_figure")
     * @IsGranted("ROLE_USER", statusCode=403)
     */
    public function updateFigure(Figure $figure, EntityManagerInterface $entityManager, Request $request, SaveRegexVideo $saveRegexVideo, SaveIllustration $saveIllustration)
    {
        
        $form = $this->createForm(FigureFormType::class, $figure)->remove('name');
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $figure->setUpdateDate(new \DateTime());

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
            $entityManager->flush();

            $this->addFlash('success', 'L\'article a bien été modifié !');

            return $this->redirectToRoute('figure', ['slug' => $figure->getSlug()]);
        }

        return $this->render('figure/update_figure.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
    }

    /**
     * @Route("/delete-figure/{slug}", name="delete_figure")
     * @IsGranted("ROLE_USER", statusCode=403)
     */
    public function deleteFigure(Figure $figure, EntityManagerInterface $entityManager){
        
            
        $entityManager->remove($figure);
        $entityManager->flush();

        $this->addFlash('success', "La figure à bien été supprimé.");
        return $this->redirectToRoute('home');
    }
}