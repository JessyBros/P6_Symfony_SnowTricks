<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Illustration;
use App\DataFixtures\FiguresFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class IllustrationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
         $illustrationMute = new Illustration();
         $illustrationMute->setPath('mute.png')
                           ->setFigure($this->getReference('figureMute'));
         $manager->persist($illustrationMute);

         $illustrationMute = new Illustration();
         $illustrationMute->setPath('../default_figure.png')
                           ->setFigure($this->getReference('figureMute'));
         $manager->persist($illustrationMute);

         $illustrationSad = new Illustration();
         $illustrationSad->setPath('sad.png')
                           ->setFigure($this->getReference('figureSad'));
         $manager->persist($illustrationSad);

         $illustrationIndy = new Illustration();
         $illustrationIndy->setPath('indy.png')
                           ->setFigure($this->getReference('figureIndy'));
         $manager->persist($illustrationIndy);

         $illustrationStalefish = new Illustration();
         $illustrationStalefish->setPath('stalefish.png')
                           ->setFigure($this->getReference('figureStalefish'));
         $manager->persist($illustrationStalefish);
         
         $illustrationTailGrab = new Illustration();
         $illustrationTailGrab->setPath('tailGrab.png')
                           ->setFigure($this->getReference('figureTailGrab'));
         $manager->persist($illustrationTailGrab);

         $illustrationNoseGrab = new Illustration();
         $illustrationNoseGrab->setPath('noseGrab.png')
                           ->setFigure($this->getReference('figureNoseGrab'));
         $manager->persist($illustrationNoseGrab);

         $illustrationJapanAir = new Illustration();
         $illustrationJapanAir->setPath('japanAir.png')
                           ->setFigure($this->getReference('figureJapanAir'));
         $manager->persist($illustrationJapanAir);

         $illustrationSlide = new Illustration();
         $illustrationSlide->setPath('slide.png')
                           ->setFigure($this->getReference('figureSlide'));
         $manager->persist($illustrationSlide);

         $illustrationBackFlips = new Illustration();
         $illustrationBackFlips->setPath('backFlips.png')
                           ->setFigure($this->getReference('figureBackFlips'));
         $manager->persist($illustrationBackFlips);

         $illustration360 = new Illustration();
         $illustration360->setPath('360.png')
                           ->setFigure($this->getReference('figure360'));
         $manager->persist($illustration360);

         $illustrationGutterBall = new Illustration();
         $illustrationGutterBall->setPath('gutterball.png')
                           ->setFigure($this->getReference('figureGutterBall'));
         $manager->persist($illustrationGutterBall);

         $illustrationFlip900 = new Illustration();
         $illustrationFlip900->setPath('flip900.jpg')
                           ->setFigure($this->getReference('figureFlip900'));
         $manager->persist($illustrationFlip900);

         $illustrationTruckDriver = new Illustration();
         $illustrationTruckDriver->setPath('truckDriver.jpg')
                           ->setFigure($this->getReference('figureTruckDriver'));
         $manager->persist($illustrationTruckDriver);

         $illustrationSeatBelt = new Illustration();
         $illustrationSeatBelt->setPath('SeatBelt.png')
                           ->setFigure($this->getReference('figureSeatBelt'));
         $manager->persist($illustrationSeatBelt);

         $illustrationDoubleMcTwist1260 = new Illustration();
         $illustrationDoubleMcTwist1260->setPath('doubleMcTwist1260.jpeg')
                           ->setFigure($this->getReference('figureDoubleMcTwist1260'));
         $manager->persist($illustrationDoubleMcTwist1260);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            FiguresFixtures::class,
        );
    }
}
