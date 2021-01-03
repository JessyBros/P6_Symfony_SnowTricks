<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Video;
use App\DataFixtures\FiguresFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class VideoFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $videoMute = new Video();
        $videoMute->setPath('https://youtube.com/embed/Opg5g4zsiGY')
                           ->setFigure($this->getReference('figureMute'));
        $manager->persist($videoMute);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            FiguresFixtures::class,
        );
    }
}
