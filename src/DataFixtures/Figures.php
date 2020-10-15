<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Figure;
use App\Entity\User;

class Figures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName("Jimmy Sweat")
             ->setEmail("js_swowtricks@hotmail.com")
             ->setPassword("js")
             ->setPicture("jimmy_sweat.png");

        $manager->persist($user);
            
        $figure1 = new Figure();
        $figure1-> setName("mute")
                -> setDescription("saisie de la carre frontside de la planche entre les deux pieds avec la main avant")
                -> setFigureGroupe("grabs")
                -> setUser($user);
        $manager->persist($figure1);

        $figure2 = new Figure();
        $figure2-> setName("sad")
                -> setDescription("saisie de la carre backside de la planche, entre les deux pieds, avec la main avant")
                -> setFigureGroupe("grabs")
                -> setUser($user);
        $manager->persist($figure2);

        $figure3 = new Figure();
        $figure3-> setName("indy")
                -> setDescription("saisie de la carre frontside de la planche, entre les deux pieds, avec la main arrière")
                -> setFigureGroupe("grabs")
                -> setUser($user);
        $manager->persist($figure3);

        $figure4 = new Figure();
        $figure4-> setName("stalefish")
                -> setDescription("saisie de la carre backside de la planche entre les deux pieds avec la main arrière")
                -> setFigureGroupe("grabs")
                -> setUser($user);
        $manager->persist($figure4);

        $figure5 = new Figure();
        $figure5-> setName("tail grab")
                -> setDescription("saisie de la partie arrière de la planche, avec la main arrière")
                -> setFigureGroupe("grabs")
                -> setUser($user);
        $manager->persist($figure5);

        $figure6 = new Figure();
        $figure6-> setName("nose grab")
                -> setDescription("saisie de la partie avant de la planche, avec la main avant")
                -> setFigureGroupe("grabs")
                -> setUser($user);
        $manager->persist($figure6);

        $figure7 = new Figure();
        $figure7-> setName("japan air")
                -> setDescription("saisie de l'avant de la planche, avec la main avant, du côté de la carre frontside")
                -> setFigureGroupe("grabs")
                -> setUser($user);
        $manager->persist($figure7);

        $figure8 = new Figure();
        $figure8-> setName("slide")
                -> setDescription("Un slide consiste à glisser sur une barre de slide. Le slide se fait soit avec la planche dans l'axe de la barre, soit perpendiculaire, soit plus ou moins désaxé")
                -> setFigureGroupe("slides")
                -> setUser($user);
        $manager->persist($figure8);


        $figure9 = new Figure();
        $figure9-> setName("back flips")
                -> setDescription("saisie du carre avant et carre arrière avec chaque mainotations en arrière")
                -> setFigureGroupe("flips")
                -> setUser($user);
        $manager->persist($figure9);

        $figure10 = new Figure();
        $figure10-> setName("360")
                -> setDescription("trois six pour un tour complet ")
                -> setFigureGroupe("rotation")
                -> setUser($user);
        $manager->persist($figure10);

        
        $manager->flush();
    }
}
