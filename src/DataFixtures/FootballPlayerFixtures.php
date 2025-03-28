<?php

namespace App\DataFixtures;

use App\Entity\Product\FootballPlayer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FootballPlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $playersData = [
            [
                'name' => 'Messi',
                'firstName' => 'Lionel',
                'valueMoney' => 100000000,
                'currentClub' => 'PSG',
                'currentRole' => 'Forward'
            ],
            [
                'name' => 'Ronaldo',
                'firstName' => 'Cristiano',
                'valueMoney' => 90000000,
                'currentClub' => 'Manchester United',
                'currentRole' => 'Forward'
            ],
            [
                'name' => 'Neymar',
                'firstName' => 'Neymar',
                'valueMoney' => 80000000,
                'currentClub' => 'PSG',
                'currentRole' => 'Forward'
            ],
        ];

        foreach ($playersData as $data) {
            $player = new FootballPlayer();
            $player->setName($data['name']);
            $player->setFirstName($data['firstName']);
            $player->setValueMoney($data['valueMoney']);
            $player->setCurrentClub($data['currentClub']);
            $player->setCurrentRole($data['currentRole']);

            $manager->persist($player);
        }

        $manager->flush();
    }
}
