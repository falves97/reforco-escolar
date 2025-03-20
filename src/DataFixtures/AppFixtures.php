<?php

namespace App\DataFixtures;

use App\Factory\ProfessorFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = UserFactory::createOne(['email' => 'user@email.com', 'password' => 'password']);
        $professor = ProfessorFactory::createOne(['email' => 'professor@email.com', 'password' => 'password']);
    }
}
