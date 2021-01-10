<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Figure;
use App\Entity\User;
use App\Entity\Video;
use App\Form\CommentFormType;
use App\Form\FigureFormType;
use App\Service\SaveIllustration;
use App\Service\SaveRegexVideo;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
    public const MAX_ITEMS_PER_PAGE = 10;

    /**
     * @Route("/figure/{slug}", name="show_figure")
     */
    public function showFigure(Figure $figure, EntityManagerInterface $entityManager, Request $request, PaginatorInterface $paginator)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        $comments = $this->getDoctrine()->getRepository(Comment::class)->findByFigure($figure->getId(), ['date' => 'desc']);
        $commentsPaginator = $paginator->paginate(
            $comments,
            $request->query->getInt('page', 1),
            self::MAX_ITEMS_PER_PAGE
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setDate(new \DateTime())
                ->setFigure($figure)
                ->setUser($this->getUser());

            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Votre commentaire a bien été enregistré !');

            return $this->redirectToRoute('show_figure', ['slug' => $figure->getSlug()]);
        }

        return $this->render('figure/figure.html.twig', [
            'figure' => $figure,
            'comment_form' => $form->createView(),
            'comments' => $comments,
            'commentsPaginator' => $commentsPaginator,
        ]);
    }

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

            if ($illustrations = $form->get('illustrations')) {
                foreach ($illustrations as $illustration) {
                    if (null != $illustration->get('file')->getData()) {
                        $uploadedFile = $illustration->get('file')->getData();
                        $saveIllustration->save($illustration->getData(), $uploadedFile);
                    }
                }
            }

            if ($videos = $form->get('videos')) {
                foreach ($videos as $video) {
                    $saveRegexVideo->save($video);
                }
            }

            $entityManager->persist($figure);
            $entityManager->flush();

            $this->addFlash('success', 'Votre article a bien été crée !');

            return $this->redirectToRoute('show_figure', ['slug' => $figure->getSlug()]);
        }

        return $this->render('figure/add_figure.html.twig', [
            'figure_form' => $form->createView(),
            'figure' => $figure,
        ]);
    }

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

            if ($illustrations = $form->get('illustrations')) {
                foreach ($illustrations as $illustration) {
                    if (null != $illustration->get('file')->getData()) {
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

            return $this->redirectToRoute('show_figure', ['slug' => $figure->getSlug()]);
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
    public function deleteFigure(Figure $figure, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($figure);
        $entityManager->flush();

        $this->addFlash('success', 'La figure à bien été supprimé.');

        return $this->redirectToRoute('home');
    }
}
