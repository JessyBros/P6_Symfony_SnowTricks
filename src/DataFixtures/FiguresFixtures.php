<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Figure;
use App\DataFixtures\GroupFixtures;
use App\DataFixtures\UserFixtures;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class FiguresFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $figureMute = new Figure();
        $figureMute-> setName("Mute")
                -> setDescription("saisie de la carre frontside de la planche entre les deux pieds avec la main avant")
                -> setDate(new \DateTime("2020-09-12 9:30:55"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("mute");
        $manager->persist($figureMute);

        $figureSad = new Figure();
        $figureSad-> setName("sad")
                -> setDescription("saisie de la carre backside de la planche, entre les deux pieds, avec la main avant")
                -> setDate(new \DateTime("2020-09-27 15:32:21"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("sad");
        $manager->persist($figureSad);

        $figureIndy = new Figure();
        $figureIndy-> setName("Indy")
                -> setDescription("saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière")
                -> setDate(new \DateTime("2020-10-01 18:24:21"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("indy");
        $manager->persist($figureIndy);

        $figureStalefish = new Figure();
        $figureStalefish-> setName("Stalefish")
                -> setDescription("saisie de la carre backside de la planche entre les deux pieds avec la main arrière")
                -> setDate(new \DateTime("2020-10-04 7:12:29"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("stalefish");
        $manager->persist($figureStalefish);

        $figureTailGrab = new Figure();
        $figureTailGrab-> setName("Tail Grab")
                -> setDescription("saisie de la partie arrière de la planche, avec la main arrière")
                -> setDate(new \DateTime("2020-10-05 9:42:58"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("tail-grab");
        $manager->persist($figureTailGrab);

        $figureNoseGrab = new Figure();
        $figureNoseGrab-> setName("Nose Grab")
                -> setDescription("saisie de la partie avant de la planche, avec la main avant")
                -> setDate(new \DateTime("2020-10-05 9:57:08"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("nose-grab");
        $manager->persist($figureNoseGrab);

        $figureJapanAir = new Figure();
        $figureJapanAir-> setName("Japan Air")
                -> setDescription("saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside")
                -> setDate(new \DateTime("2020-10-12 19:12:38"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("japan-air");
        $manager->persist($figureJapanAir);

        $figureSlide = new Figure();
        $figureSlide-> setName("Slide")
                -> setDescription("Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé")
                -> setDate(new \DateTime("2020-10-10 17:41:18"))
                -> setGroupType($this->getReference('groupSlide'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("slide");
        $manager->persist($figureSlide);


        $figureBackFlips = new Figure();
        $figureBackFlips-> setName("Back Flips")
                -> setDescription("rotation en arrière")
                -> setDate(new \DateTime("2020-10-17 12:21:47"))
                -> setGroupType($this->getReference('groupFlip'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("black-flips");
        $manager->persist($figureBackFlips);

        $figure360 = new Figure();
        $figure360-> setName("360")
                -> setDescription("trois six pour un tour complet")
                -> setDate(new \DateTime("2020-10-21 20:31:07"))
                -> setGroupType($this->getReference('groupRotation'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("360");
        $manager->persist($figure360);

        $figureGutterBall = new Figure();
        $figureGutterBall-> setName("Gutter Ball")
                -> setDescription("Le Gutterball est un slide avant à un pied (le pied avant est attaché et le pied arrière est dégagé).")
                -> setDate(new \DateTime("2020-10-29 08:27:13"))
                -> setGroupType($this->getReference('groupSlide'))
                -> setUser($this->getReference('userJessy'))
                -> setSlug("gutter-ball");
        $manager->persist($figureGutterBall);

        $figureFlip900 = new Figure();
        $figureFlip900-> setName("Flip 900")
                -> setDescription("Le snowboarder effectue une rotation de 900 degrès pendant le saut.")
                -> setDate(new \DateTime("2020-11-07 18:57:21"))
                -> setGroupType($this->getReference('groupFlip'))
                -> setUser($this->getReference('userJessy'))
                -> setSlug("flip-900");
        $manager->persist($figureFlip900);

        $figureTruckDriver = new Figure();
        $figureTruckDriver-> setName("Truck Driver")
                -> setDescription("Saisie du carre avant et carre arrière avec chaque main (comme tenir un volant de voiture).")
                -> setDate(new \DateTime("2020-11-11 09:32:21"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("truck-driver");
        $manager->persist($figureTruckDriver);

        $figureSeatBelt = new Figure();
        $figureSeatBelt-> setName("Seat Belt")
                -> setDescription("saisie du carre frontside à l'arrière avec la main avant.")
                -> setDate(new \DateTime("2020-11-17 19:11:47"))
                -> setGroupType($this->getReference('groupGrap'))
                -> setUser($this->getReference('userJimmy'))
                -> setSlug("seat-belt");
        $manager->persist($figureSeatBelt);

        $figureDoubleMcTwist1260 = new Figure();
        $figureDoubleMcTwist1260-> setName("Double Mc Twist 1260")
                -> setDescription("Le Mc Twist est un flip (rotation verticale) agrémenté d'une vrille.")
                -> setDate(new \DateTime("2020-11-28 07:27:00"))
                -> setGroupType($this->getReference('groupFlip'))
                -> setUser($this->getReference('userJessy'))
                -> setSlug("double-mc-twist-1260");
        $manager->persist($figureDoubleMcTwist1260);

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
        $this->addReference('figureGutterBall', $figureGutterBall);
        $this->addReference('figureFlip900', $figureFlip900);
        $this->addReference('figureTruckDriver', $figureTruckDriver);
        $this->addReference('figureSeatBelt', $figureSeatBelt);
        $this->addReference('figureDoubleMcTwist1260', $figureDoubleMcTwist1260);
    }

    public function getDependencies()
    {
        return array(
            GroupFixtures::class,
            UserFixtures::class,
        );
    }
}