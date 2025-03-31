<?php
// src/DataFixtures/CountryFixtures.php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countries = [
            ['name' => 'France',  'code' => 'FR'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Italy',   'code' => 'IT'],
            ['name' => 'UK',      'code' => 'UK'],
            ['name' => 'Espagna', 'code' => 'ES'],
        ];

        foreach ($countries as $data) {
            $country = new Country();
            $country->setName($data['name']);
            $country->setCode($data['code']);
            $manager->persist($country);
        }

        $manager->flush();
    }
}
