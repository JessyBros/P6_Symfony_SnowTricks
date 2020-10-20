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

        $manager->flush();
        
    }

    public function getDependencies()
    {
        return array(
            FiguresFixtures::class,
        );
    }
}
