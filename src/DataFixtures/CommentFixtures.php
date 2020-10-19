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
         $commentJessyfigureMute = new Comment();
         $commentJessyfigureMute   ->setMessage("Quel nostalgie, ma toute première figure ! :)")
                            ->setDate(new \DateTime("2020-10-25 18:40:55"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($commentJessyfigureMute);

        $commentCrystelfigureMute = new Comment();
         $commentCrystelfigureMute   ->setMessage("C'est marrant, je début et je commence par celle-ci. Elle me plaît bien ;)")
                            ->setDate(new \DateTime("2020-10-27 11:28:15"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userCrystel'));
        $manager->persist($commentCrystelfigureMute);

        $commentJessy2figureMute = new Comment();
         $commentJessy2figureMute   ->setMessage("Le tout, c'est de rester sur ses appuis.")
                            ->setDate(new \DateTime("2020-10-27 13:58:02"))
                            ->setFigure($this->getReference('figureMute'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($commentJessy2figureMute);

        $commentJessyfigureJapanAir = new Comment();
         $commentJessyfigureJapanAir   ->setMessage("Une figure choisis par rapport au nom xD J'y arriverai bientôt à la faire je le sens !")
                            ->setDate(new \DateTime("2020-10-25 07:37:51"))
                            ->setFigure($this->getReference('figureJapanAir'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($commentJessyfigureJapanAir);

        $commentJessyfigure360 = new Comment();
         $commentJessyfigure360   ->setMessage("Suffit de tourner sur soi non ? :p")
                            ->setDate(new \DateTime("2020-10-30 21:07:40"))
                            ->setFigure($this->getReference('figure360'))
                            ->setUser($this->getReference('userJessy'));
        $manager->persist($commentJessyfigureMute);

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
