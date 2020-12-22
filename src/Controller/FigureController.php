<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Figure;
use App\Entity\Comment;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FigureController extends AbstractController
{
    const MAX_ITEMS_PER_PAGE = 10;

    /**
     * @Route("/figure/{slug}", name="figure")
     */
    public function figure(Figure $figure, EntityManagerInterface $entityManager, Request $request, PaginatorInterface $paginator)
    {
        //Formulaire des commentaires
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        //Affichage des commentaire et pagination
        $commentsData = $this->getDoctrine()->getRepository(Comment::class)->findByFigure($figure->getId(),['date' => 'desc']);
        $comments = $paginator->paginate(
            $commentsData,
            $request->query->getInt('page',1),
            self::MAX_ITEMS_PER_PAGE

        );    

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new \DateTime())
                ->setFigure($figure)
                ->setUser($this->getUser());
                
            $entityManager->persist($comment);
            $entityManager->flush();
          
            $this->addFlash('success', 'Votre commentaire a bien été enregistré !');

            return $this->redirectToRoute('figure', ['slug' => $figure->getSlug()]);
        }

        return $this->render('figure/figure.html.twig', [
            'figure' => $figure,
            'comment_form' => $form->createView(),
            'comments' => $comments,
            'commentsData' => $commentsData,
        ]);
    }
}