<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Group;

class GroupFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $groupGrap = new Group();
        $groupGrap->setName("Grap");
        $manager->persist($groupGrap);
       
        $groupRotation = new Group();
        $groupRotation->setName('Rotation');
        $manager->persist($groupRotation);

        $groupFlip = new Group();
        $groupFlip->setName('Flip');
        $manager->persist($groupFlip);

        $groupSlide = new Group();
        $groupSlide->setName('Slide');
        $manager->persist($groupSlide);

        $groupRotationDesaxer = new Group();
        $groupRotationDesaxer->setName('Rotation desaxer');
        $manager->persist($groupRotationDesaxer);

        $groupOldSchool = new Group();
        $groupOldSchool->setName('Old school');
        $manager->persist($groupOldSchool);

        $groupAutre = new Group();
        $groupAutre->setName('Autre');
        $manager->persist($groupAutre);

        $manager->flush();

        $this->addReference('groupGrap', $groupGrap);
        $this->addReference('groupRotation', $groupRotation);
        $this->addReference('groupFlip', $groupFlip);
        $this->addReference('groupSlide', $groupSlide);
        $this->addReference('groupRotationDesaxer', $groupRotationDesaxer);
        $this->addReference('groupOldSchool', $groupOldSchool);
        $this->addReference('groupAutre', $groupAutre);
    }
}