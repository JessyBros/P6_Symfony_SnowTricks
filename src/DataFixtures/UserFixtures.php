<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $userJimmy = new User();
        $userJimmy->setUsername("Jimmy Sweat")
             ->setEmail("js_swowtricks@hotmail.com")
             ->setPassword("js")
             ->setPicture("jimmy_sweat.png");
        $manager->persist($userJimmy);

        $userJessy = new User();
        $userJessy->setUsername("Jessy")
             ->setEmail("j.bros@hotmail.fr")
             ->setPassword("jb")
             ->setPicture("jessy.png");
        $manager->persist($userJessy);

        $userCrystel = new User();
        $userCrystel->setUsername("Crystel")
             ->setEmail("Crystel@hotmail.com")
             ->setPassword("Crystel")
             ->setPicture("Crystel.jpg");
        $manager->persist($userCrystel);

        $manager->flush();

        $this->addReference('userJimmy', $userJimmy);
        $this->addReference('userJessy', $userJessy);
        $this->addReference('userCrystel', $userCrystel);
    }
}
