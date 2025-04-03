<?php
// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $usersData = [
            [
                'login'    => 'sadmin',
                'password' => 'nimdas',
                'roles'    => ['ROLE_SUPER_ADMIN'],
                'name'     => 'Super Admin',
                'country'  => 'FR',
            ],
            [
                'login'    => 'gilles',
                'password' => 'sellig',
                'roles'    => ['ROLE_ADMIN'],
                'name'     => 'Gilles',
                'country'  => 'FR',
            ],
            [
                'login'    => 'rita',
                'password' => 'atir',
                'roles'    => ['ROLE_CLIENT'],
                'name'     => 'Rita',
                'country'  => 'FR',
            ],
            [
                'login'    => 'boumediene',
                'password' => 'eneidemuob',
                'roles'    => ['ROLE_CLIENT'],
                'name'     => 'Boumediene',
                'country'  => 'FR',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = new User();
            $user->setLogin($userData['login']);
            $user->setName($userData['name']);
            $user->setRoles($userData['roles']);
            $user->setCountry($userData['country']);
            $hashedPassword = $this->passwordHasher->hashPassword($user, $userData['password']);
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
