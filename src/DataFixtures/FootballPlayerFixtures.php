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
                'valueMoney' => 10000000,
                'currentClub' => 'Inter Miami',
                'currentRole' => 'Coach'
            ],
            [
                'name' => 'Ronaldo',
                'firstName' => 'Cristiano',
                'valueMoney' => 9000000,
                'currentClub' => 'Al Nassr',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Jr',
                'firstName' => 'Neymar',
                'valueMoney' => 80000000,
                'currentClub' => 'Santos',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Jr',
                'firstName' => 'Neymar',
                'valueMoney' => 80000000,
                'currentClub' => 'PSG',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Haaland',
                'firstName' => 'Erling',
                'valueMoney' => 200000000,
                'currentClub' => 'Manchester City',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Vinicius Junior',
                'firstName' => 'Vinicius',
                'valueMoney' => 200000000,
                'currentClub' => 'Real Madrid',
                'currentRole' => 'Ailier gauche'
            ],
            [
                'name' => 'Mbappé',
                'firstName' => 'Kylian',
                'valueMoney' => 170000000,
                'currentClub' => 'Real Madrid',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Dembélé',
                'firstName' => 'Ousmane',
                'valueMoney' => 75000000,
                'currentClub' => 'Paris Saint-Germain',
                'currentRole' => 'Ailier droit'
            ],
            [
                'name' => 'Kvaratskhelia',
                'firstName' => 'Khvicha',
                'valueMoney' => 80000000,
                'currentClub' => 'Paris Saint-Germain',
                'currentRole' => 'Ailier gauche'
            ],
            [
                'name' => 'Barcola',
                'firstName' => 'Bradley',
                'valueMoney' => 70000000,
                'currentClub' => 'Paris Saint-Germain',
                'currentRole' => 'Ailier gauche'
            ],
            [
                'name' => 'Hakimi',
                'firstName' => 'Achraf',
                'valueMoney' => 65000000,
                'currentClub' => 'Paris Saint-Germain',
                'currentRole' => 'Arrière droit'
            ],
            [
                'name' => 'Saka',
                'firstName' => 'Bukayo',
                'valueMoney' => 150000000,
                'currentClub' => 'Arsenal FC',
                'currentRole' => 'Ailier droit'
            ],
            [
                'name' => 'Foden',
                'firstName' => 'Phil',
                'valueMoney' => 130000000,
                'currentClub' => 'Manchester City',
                'currentRole' => 'Ailier droit'
            ],
            [
                'name' => 'Rodri',
                'firstName' => 'Rodrigo',
                'valueMoney' => 130000000,
                'currentClub' => 'Manchester City',
                'currentRole' => 'Milieu défensif'
            ],

            [
                'name' => 'Musiala',
                'firstName' => 'Jamal',
                'valueMoney' => 110000000,
                'currentClub' => 'Bayern Munich',
                'currentRole' => 'Milieu offensif'
            ],
            [
                'name' => 'Gavi',
                'firstName' => 'Pablo',
                'valueMoney' => 90000000,
                'currentClub' => 'FC Barcelone',
                'currentRole' => 'Milieu central'
            ],
            [
                'name' => 'Pedri',
                'firstName' => 'Pedro',
                'valueMoney' => 100000000,
                'currentClub' => 'FC Barcelone',
                'currentRole' => 'Milieu central'
            ],
            [
                'name' => 'De Bruyne',
                'firstName' => 'Kevin',
                'valueMoney' => 80000000,
                'currentClub' => 'Manchester City',
                'currentRole' => 'Milieu offensif'
            ],
            [
                'name' => 'Osimhen',
                'firstName' => 'Victor',
                'valueMoney' => 100000000,
                'currentClub' => 'Galatasaray',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Kane',
                'firstName' => 'Harry',
                'valueMoney' => 95000000,
                'currentClub' => 'Bayern Munich',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Salah',
                'firstName' => 'Mohamed',
                'valueMoney' => 70000000,
                'currentClub' => 'Liverpool FC',
                'currentRole' => 'Ailier droit'
            ],
            [
                'name' => 'Rodrygo',
                'firstName' => 'Rodrygo',
                'valueMoney' => 100000000,
                'currentClub' => 'Real Madrid',
                'currentRole' => 'Ailier droit'
            ],
            [
                'name' => 'Sané',
                'firstName' => 'Leroy',
                'valueMoney' => 70000000,
                'currentClub' => 'Bayern Munich',
                'currentRole' => 'Ailier droit'
            ],
            [
                'name' => 'Gnabry',
                'firstName' => 'Serge',
                'valueMoney' => 65000000,
                'currentClub' => 'Bayern Munich',
                'currentRole' => 'Ailier droit'
            ],
            [
                'name' => 'Martínez',
                'firstName' => 'Lautaro',
                'valueMoney' => 85000000,
                'currentClub' => 'Inter Milan',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Leão',
                'firstName' => 'Rafael',
                'valueMoney' => 85000000,
                'currentClub' => 'AC Milan',
                'currentRole' => 'Ailier gauche'
            ],
            [
                'name' => 'Fernández',
                'firstName' => 'Enzo',
                'valueMoney' => 121000000,
                'currentClub' => 'Chelsea FC',
                'currentRole' => 'Milieu central'
            ],
            [
                'name' => 'Rice',
                'firstName' => 'Declan',
                'valueMoney' => 116600000,
                'currentClub' => 'Arsenal FC',
                'currentRole' => 'Milieu central'
            ],
            [
                'name' => 'Alvarez',
                'firstName' => 'Julián',
                'valueMoney' => 90000000,
                'currentClub' => 'Atlético de Madrid',
                'currentRole' => 'Avant-centre'
            ],
            [
                'name' => 'Kvaratskhelia',
                'firstName' => 'Khvicha',
                'valueMoney' => 85000000,
                'currentClub' => 'Paris Saint-Germain',
                'currentRole' => 'Ailier gauche'
            ],
            [
                'name' => 'Simons',
                'firstName' => 'Xavi',
                'valueMoney' => 80000000,
                'currentClub' => 'RB Leipzig',
                'currentRole' => 'Milieu offensif'
            ],
            [
                'name' => 'Luiz',
                'firstName' => 'Douglas',
                'valueMoney' => 70000000,
                'currentClub' => 'Juventus Turin',
                'currentRole' => 'Milieu central'
            ],
            [
                'name' => 'de Ligt',
                'firstName' => 'Matthijs',
                'valueMoney' => 65000000,
                'currentClub' => 'Manchester United',
                'currentRole' => 'Défenseur central'
            ],
            [
                'name' => 'Yoro',
                'firstName' => 'Leny',
                'valueMoney' => 50000000,
                'currentClub' => 'Manchester United',
                'currentRole' => 'Défenseur central'
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
