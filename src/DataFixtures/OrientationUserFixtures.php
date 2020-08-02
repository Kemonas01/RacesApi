<?php

namespace App\DataFixtures;
use Faker;

use App\Entity\OrientationUser;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
function getHttpCode($http_response_header)
{
    if(is_array($http_response_header))
    {
        $parts=explode(' ',$http_response_header[0]);
        if(count($parts)>1) //HTTP/1.0 code text
            return intval($parts[1]); //Get code
    }
    return 0;
}

class OrientationUserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i<6;$i++){
            $user = New OrientationUser();
            $user->setFirstname($faker->firstname);
            $user->setLastname($faker->lastname);
            $user->setLogin("user".$i);
            $user->setRoles(['test']);
            $email = $user->getFirstname().'.'.$user->getLastname().'@dpt-info.fr';
            $user->setMail($email);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'test'
            ));            $content = null;
            while (true) {
            $content = @file_get_contents("https://robohash.org/test?size=50x50");
            if (getHttpCode($http_response_header) === 200) {
                break;
            }
            echo "Erreur de chargement";
            }
            $user->setAvatar($content);
            $manager->persist($user);
        }
        $manager->flush();
        $manager->clear();    
        
    }
}
