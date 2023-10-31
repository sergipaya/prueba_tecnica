<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setNombre($faker->firstName);
            $user->setApellidos($faker->lastName);
            $user->setFecnac($faker->dateTimeBetween('1940-01-01', '2005-01-01'));
            $user->setEstado(true);
            $user->setSexo($faker->randomElement(['hombre', 'mujer']));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
