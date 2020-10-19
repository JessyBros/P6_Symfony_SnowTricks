<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Figure;
use App\DataFixtures\UserFixtures;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FiguresFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
                   
        $figureMute = new Figure();
        $figureMute-> setName("mute")
                -> setDescription("saisie de la carre frontside de la planche entre les deux pieds avec la main avant")
                -> setFigureGroupe("grabs")
                -> setDate(new \DateTime("2020-09-12 9:30:55"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureMute);

        $figureSad = new Figure();
        $figureSad-> setName("sad")
                -> setDescription("saisie de la carre backside de la planche, entre les deux pieds, avec la main avant")
                -> setFigureGroupe("grabs")
                -> setDate(new \DateTime("2020-09-27 15:32:21"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureSad);

        $figureIndy = new Figure();
        $figureIndy-> setName("indy")
                -> setDescription("saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière")
                -> setFigureGroupe("grabs")
                -> setDate(new \DateTime("2020-10-01 18:24:21"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureIndy);

        $figureStalefish = new Figure();
        $figureStalefish-> setName("stalefish")
                -> setDescription("saisie de la carre backside de la planche entre les deux pieds avec la main arrière")
                -> setFigureGroupe("grabs")
                -> setDate(new \DateTime("2020-10-04 7:12:29"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureStalefish);

        $figureTailGrab = new Figure();
        $figureTailGrab-> setName("tail grab")
                -> setDescription("saisie de la partie arrière de la planche, avec la main arrière")
                -> setFigureGroupe("grabs")
                -> setDate(new \DateTime("2020-10-05 9:42:58"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureTailGrab);

        $figureNoseGrab = new Figure();
        $figureNoseGrab-> setName("nose grab")
                -> setDescription("saisie de la partie avant de la planche, avec la main avant")
                -> setFigureGroupe("grabs")
                -> setDate(new \DateTime("2020-10-05 9:57:08"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureNoseGrab);

        $figureJapanAir = new Figure();
        $figureJapanAir-> setName("japan air")
                -> setDescription("saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside")
                -> setFigureGroupe("grabs")
                -> setDate(new \DateTime("2020-10-12 19:12:38"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureJapanAir);

        $figureSlide = new Figure();
        $figureSlide-> setName("slide")
                -> setDescription("Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé")
                -> setFigureGroupe("slides")
                -> setDate(new \DateTime("2020-10-10 17:41:18"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureSlide);


        $figureBackFlips = new Figure();
        $figureBackFlips-> setName("back flips")
                -> setDescription("rotation en arrière")
                -> setFigureGroupe("flips")
                -> setDate(new \DateTime("2020-10-17 12:21:47"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figureBackFlips);

        $figure360 = new Figure();
        $figure360-> setName("360")
                -> setDescription("trois six pour un tour complet ")
                -> setFigureGroupe("rotation")
                -> setDate(new \DateTime("2020-10-21 20:31:07"))
                -> setUser($this->getReference('userJimmy'));
        $manager->persist($figure360);

        
        $manager->flush();

        $this->addReference('figureMute', $figureMute);
        $this->addReference('figureSad', $figureSad);
        $this->addReference('figureIndy', $figureIndy);
        $this->addReference('figureStalefish', $figureStalefish);
        $this->addReference('figureTailGrab', $figureTailGrab);
        $this->addReference('figureNoseGrab', $figureNoseGrab);
        $this->addReference('figureJapanAir', $figureJapanAir);
        $this->addReference('figureSlide', $figureSlide);
        $this->addReference('figureBackFlips', $figureBackFlips);
        $this->addReference('figure360', $figure360);
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
