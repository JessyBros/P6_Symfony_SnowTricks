<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Illustration;
use App\Entity\User;
use App\Form\FigureFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class AddFigureController extends AbstractController
{
    /**
     * @Route("/ajouter-une-figure", name="add_figure")
     */
    public function addFigure(EntityManagerInterface $entityManager,Request $request)
    {
        $figure = new Figure();

        $illustration = new Illustration();
        $illustration->setPath('path/ok');

        $form =$this->createForm(FigureFormType::class, $figure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $figure->setDate(new \DateTime())
                    ->setUser($this->getDoctrine()->getRepository(User::class)->find(46))
            
            ;
            $illustration->setFigure($figure);

            $figure->getIllustrations()->add($illustration);

            $entityManager->persist($illustration);
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