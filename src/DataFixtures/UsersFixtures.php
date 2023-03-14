<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $Users= new User();
        $Users-> setNom("Nazir");
        $Users-> setprenom("Faissal");
        $Users-> setdate_naissance("11/12/2002");
        // $product = new Product();
         $manager->persist($Users);

        $manager->flush();
    }
}
