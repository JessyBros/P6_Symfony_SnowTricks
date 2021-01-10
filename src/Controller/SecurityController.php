<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="sign_in")
     */
    public function signIn()
    {
        return $this->render('security/sign_in.html.twig');
    }

    /**
     * @Route("/inscription", name="register")
     */
    public function register(EntityManagerInterface $entityManager, Request $request, string $pictureDir, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $picture = $form->get('picture')->getData();
            $pictureName = bin2hex(random_bytes(6)).'.'.$picture->guessExtension();
            try {
                $picture->move($pictureDir, $pictureName);
            } catch (FileException $e) {
            }
            $user->setPicture($pictureName);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre inscription a été effectué avec succès !');

            return $this->redirectToRoute('sign_in');
        }

        return $this->render('security/register.html.twig', [
            'formSignUp' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deconnexion", name="log_out")
     */
    public function logOut()
    {
    }
}
