<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $entityManager)
    {
        $figureList = $this->getDoctrine()->getRepository(Figure::class)->findAll();

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

        return $this->render('home.html.twig', [
            'figures' => $figureList
        ]);
    }
}
