<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Illustration;
use App\Entity\Video;
use App\Entity\User;
use App\Form\FigureFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;




class AddFigureController extends AbstractController
{
    /**
     * @Route("/ajouter-une-figure", name="add_figure")
     */
    public function addFigure(EntityManagerInterface $entityManager,Request $request, string $photoDir)
    {
        $figure = new Figure();
        $illustration = new Illustration();
        $video = new Video();

        $form =$this->createForm(FigureFormType::class, $figure);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){

            $figure->setDate(new \DateTime())
                    ->setUser($this->getDoctrine()->getRepository(User::class)->find(1))


                   

            ;
            
            if ($illustrationFiles = $form->get('illustrations')->getData()) {
                foreach ($illustrationFiles as $illustrationFile){
                    $filename = bin2hex(random_bytes(6)).'.'.$illustrationFile->guessExtension();
                    
                    try {
                            $illustrationFile->move($photoDir, $filename);
                        } catch (FileException $e) {
                                            // unable to upload the photo, give up
                        }
                        //$comment->setPhotoFilename($filename);
                }
            }



            $entityManager->persist($figure);
            
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('add_figure/index.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
        
    }

}