<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\OrientationRace;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class OrientationRaceFixtures extends Fixture
{
    public function __construct(){
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $listeRace = ["URCA", "Montagne de Reims", "Paris", "Parc de champagne"];
        foreach($listeRace as $lieu){
            for ($i = 0; $i<8;$i++){
                $orientationRace = New OrientationRace();
                $annee = 2013+$i;
                $name = $lieu." ".$annee;
                $orientationRace->setName($name);
                $orientationRace->setDescription($faker->paragraph());
                $orientationRace->setWillStartAt($faker->dateTimeBetween('-7 years','+1 years'));
                if( strtotime($orientationRace->getWillStartAt()->format('Y-m-d')) > strtotime('now'))
                    $orientationRace->setIsClosed(false);
                else
                    $orientationRace->setIsClosed(true);
                $manager->persist($orientationRace);
            }
            
        }
        $manager->flush();
        $manager->clear();
    }
}
