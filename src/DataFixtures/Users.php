<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class Users extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*$user = new User();
        $user->setName("Jimmy Sweat")
             ->setEmail("js_swowtricks@hotmail.com")
             ->setPassword("js")
             ->setPicture("jimmy_sweat.png");

        $manager->persist($user);

        $manager->flush();*/
    }
}
