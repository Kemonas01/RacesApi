<?php

namespace App\DataFixtures;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\OrientationRegistered;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class OrientationRegisteredFixtures extends Fixture
{

    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $entityManager = $this->entityManager->getDoctrine()->getRepository("OrentationRace");
        
    }
}
