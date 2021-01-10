<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPassType;
use App\Repository\UserRepository;
use App\Service\MailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class ForgottenPasswordController extends AbstractController
{
    /**
     * @Route("/mot-de-passe-oublie", name="forgotten_password")
     */
    public function forgottenPassword(Request $request, UserRepository $userRepo, TokenGeneratorInterface $tokenGenerator, MailService $mailService, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ResetPassType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userRepo->findOneByEmail($form->getData()['email']);
            if ($user) {
                $token = $tokenGenerator->generateToken();
                try {
                    $user->setResetToken($token);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();
                } catch (\Exception $e) {
                    $this->addFlash('warning', 'Une erreur est survenue : '.$e->getMessage());
                    $this->redirectToRoute('sign_in');
                }

                // On génère l'URL de réinitialisation de mot de passe
                $url = $this->generateUrl('reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                $mailService->ForgottenPasswordMail($user->getEmail(), $url, $mailer);
            }
            $this->addFlash('success', 'Si votre adresse email est bien enregistré, vous recevrez un email de réinitialisation de mot de passe');
        }

        return $this->render('security/forgotten_password.html.twig', [
            'ForgottenPasswordForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("reset-password/{token}", name="reset_password")
     */
    public function resetPassword($token, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            $this->addFlash('danger', 'Token inconnu');
            $this->redirectToRoute('sign_in');
        }

        if ($request->isMethod('POST')) {
            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe modifié avec succès');

            return $this->redirectToRoute('sign_in');
        } else {
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }
    }
}
