<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Figure;
use App\Entity\Comment;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FigureController extends AbstractController
{
    /**
     * @Route("/figure/{id}", name="figure")
     */
    public function figure(Figure $figure, EntityManagerInterface $entityManager, Request $request)
    {
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findByFigure($figure->getId());

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new \DateTime())
                ->setFigure($figure)
                ->setUser($this->getDoctrine()->getRepository(User::class)->find(49));

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('figure', ['id' => $figure->getId()]);
        }

        return $this->render('figure/index.html.twig', [
            'figure' => $figure,
            'comment_form' => $form->createView(),
            'comments' => $comments,
        ]);
    }
}
