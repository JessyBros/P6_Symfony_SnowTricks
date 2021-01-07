<?php

namespace App\Service;

class MailService
{
    public function ForgottenPasswordMail($to, $url, $mailer)
    {
        // On envoie le message
        $message = (new \Swift_Message('mot de passe'))
         ->setFrom('j.bros@hotmail.fr')
         ->setTo($to)
         ->setBody(
            '<p>Bonjour,</p><p>Une demande de réinitialisation de mot de pass a été effectué.</p></p>Veuillez cliquer sur le lien suivant : '.$url.'</p>', 'text/html'
         );

        // On envoie l'email
        $mailer->send($message);
    }
}
