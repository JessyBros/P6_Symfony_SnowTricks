<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SignUpController extends AbstractController
{
    /**
     * @Route("/inscription", name="sign_up")
     */
    public function signUp(EntityManagerInterface $entityManager, Request $request, string $pictureDir, UserPasswordEncoderInterface $encoder)
    {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
          
            $picture = $form->get('picture')->getData();
            $pictureName = bin2hex(random_bytes(6)) . '.' . $picture->guessExtension();
                try {
                    $picture->move($pictureDir, $pictureName);
                } catch (FileException $e) {
                }
                $user->setPicture($pictureName);
            
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('sign_in');
        }

        return $this->render('security/sign_up.html.twig',[
            'formSignUp' => $form->createView(),
        ]);
    }
}
