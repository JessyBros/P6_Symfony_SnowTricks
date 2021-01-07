<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $userJimmy = new User();
        $userJimmy->setUsername('Jimmy Sweat')
             ->setEmail('js_swowtricks@hotmail.com')
             ->setPassword('$2y$13$C3kDgXCkq5TFBiFcXzrbRO4KK35oFiOvWGrx0D5TDlFnqNberOL/u')
             ->setPicture('jimmy_sweat.png');
        $manager->persist($userJimmy);

        $userJessy = new User();
        $userJessy->setUsername('Jessy')
             ->setEmail('j.bros@hotmail.fr')
             ->setPassword('$2y$13$C3kDgXCkq5TFBiFcXzrbRO4KK35oFiOvWGrx0D5TDlFnqNberOL/u')
             ->setPicture('jessy.png');
        $manager->persist($userJessy);

        $userCrystel = new User();
        $userCrystel->setUsername('Crystel')
             ->setEmail('Crystel@hotmail.com')
             ->setPassword('$2y$13$C3kDgXCkq5TFBiFcXzrbRO4KK35oFiOvWGrx0D5TDlFnqNberOL/u')
             ->setPicture('Crystel.jpg');
        $manager->persist($userCrystel);

        $manager->flush();

        $this->addReference('userJimmy', $userJimmy);
        $this->addReference('userJessy', $userJessy);
        $this->addReference('userCrystel', $userCrystel);
    }
}
