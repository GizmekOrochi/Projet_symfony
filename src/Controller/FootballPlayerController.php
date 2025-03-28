<?php

namespace App\Controller;

use App\Entity\Product\FootballPlayer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FootballPlayerController extends AbstractController
{
    #[Route(path: '/football-players', name: 'app_football_players')]
    public function index(EntityManagerInterface $em): Response
    {
        $players = $em->getRepository(FootballPlayer::class)->findAll();

        return $this->render('football_players/index.html.twig', [
            'players' => $players,
        ]);
    }

    #[Route(path: '/football-players/{id}', name: 'app_football_player_show')]
    public function show(int $id, EntityManagerInterface $em): Response
    {
        $player = $em->getRepository(FootballPlayer::class)->find($id);
        if (!$player) {
            throw $this->createNotFoundException('Player not found.');
        }

        return $this->render('football_players/show.html.twig', [
            'player' => $player,
        ]);
    }
}
