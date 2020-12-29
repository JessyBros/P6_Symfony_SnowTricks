<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Comment;
use App\DataFixtures\UserFixtures;
use App\DataFixtures\FiguresFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comment1 = new Comment();
        $comment1   ->setMessage("Quel nostalgie, ma toute première figure ! :)")
                            ->setDate(new \DateTime("2020-10-25 18:40:55"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2  ->setMessage("C'est marrant, je début et je commence par celle-ci. Elle me plaît bien ;)")
                            ->setDate(new \DateTime("2020-10-27 11:28:15"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userCrystel'));
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3   ->setMessage("Le tout, c'est de rester sur ses appuis.")
                            ->setDate(new \DateTime("2020-10-27 13:58:02"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment3);

        $comment4 = new Comment();
        $comment4   ->setMessage("Je progresse vite ! Je pense rapidement enchaîné sur une deuxième figure.")
                            ->setDate(new \DateTime("2020-10-29 17:20:13"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userCrystel'));
        $manager->persist($comment4);

        $comment5 = new Comment();
        $comment5  ->setMessage("Tu maîtrise la figure mute ?")
                            ->setDate(new \DateTime("2020-10-29 18:01:37"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment5);

        $comment6 = new Comment();
        $comment6   ->setMessage("Non, je fais encore quelque chute, mais ça commece à venir. Puis une autre me plaît pas mal, la 360 ! ^^")
                            ->setDate(new \DateTime("2020-11-01 07:49:21"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userCrystel'));
        $manager->persist($comment6);

        $comment7 = new Comment();
        $comment7   ->setMessage("Tu devrais consolider tes bases. Essaie plutôt le nose grab pour continuer. Bien plus facile pour débuter et avoir une bon maintient de sa planche")
                            ->setDate(new \DateTime("2020-11-02 20:10:57"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment7);

        $comment8 = new Comment();
        $comment8   ->setMessage("D'accord, je vais t'écouter. Je m'y met dès ce matin !")
                            ->setDate(new \DateTime("2020-11-03 09:53:05"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userCrystel'));
        $manager->persist($comment8);

        $comment9 = new Comment();
        $comment9    ->setMessage("Amuses-toi bien surtout. ;)")
                            ->setDate(new \DateTime("2020-11-03 09:58:12"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment9);

        $comment10 = new Comment();
        $comment10  ->setMessage("10 ème commentaire - Je tout de même voulu essayer le 360 aujourd'hui et j'ai échoué lamentablement. Trop dur..")
                            ->setDate(new \DateTime("2020-11-04 20:01:04"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userCrystel'));
        $manager->persist($comment10);

        $comment11 = new Comment();
        $comment11   ->setMessage("Ce n'est pas grave, et ne te d'écourage jamais. On apprend en faisaint des erreurs.")
                            ->setDate(new \DateTime("2020-11-04 20:17:46"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment11);

        $comment12 = new Comment();
        $comment12  ->setMessage("Crystel, vient demain matin avec moi à 10h00 sur la piste débutant. Je t'apprendrai deux ou trois trucs.")
                            ->setDate(new \DateTime("2020-11-24 21:32:14"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJimmy'));
        $manager->persist($comment12);

        $comment13 = new Comment();
        $comment13   ->setMessage("Une figure choisis par rapport au nom xD J'y arriverai bientôt à la faire je le sens !")
                            ->setDate(new \DateTime("2020-10-25 07:37:51"))
                            ->setFigure($this->getReference('figureJapanAir'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment13);

        $comment14 = new Comment();
        $comment14   ->setMessage("Suffit de tourner sur soi non ? :p")
                            ->setDate(new \DateTime("2020-10-30 21:07:40"))
                            ->setFigure($this->getReference('figure360'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($comment14);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            FiguresFixtures::class,
        );
    }
}
