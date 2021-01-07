<?php

namespace App\DataFixtures;

use App\Entity\Video;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

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
        return [
            FiguresFixtures::class,
        ];
    }
}
