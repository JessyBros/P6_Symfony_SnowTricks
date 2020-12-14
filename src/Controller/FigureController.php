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
     * @Route("/figure/{slug}", name="figure")
     */
    public function figure(Figure $figure, EntityManagerInterface $entityManager, Request $request)
    {
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findByFigure($figure->getId());

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if(isset($_POST['submit_delete_figure'])){
            $figureByPostId = $this->getDoctrine()->getRepository(Figure::class)->findOneById($_POST['figure_id']);
            $commentsFromFigure = $this->getDoctrine()->getRepository(Comment::class)->findByFigure($_POST['figure_id']);
            
            $entityManager->remove($figureByPostId);
            foreach ($commentsFromFigure as $comment){
                $entityManager->remove($comment);
            }
            
            $entityManager->flush();

            $this->addFlash('warning', "La figure à bien été supprimé.");
            return $this->redirectToRoute('home');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new \DateTime())
                ->setFigure($figure)
                ->setUser($this->getUser());
                
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('figure', ['slug' => $figure->getSlug()]);
        }

        return $this->render('figure/figure.html.twig', [
            'figure' => $figure,
            'comment_form' => $form->createView(),
            'comments' => $comments,
        ]);
    }
}