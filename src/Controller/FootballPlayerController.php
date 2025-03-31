<?php

namespace App\Controller;

use App\Entity\Product\FootballPlayer;
use App\Form\FootballPlayerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route(path: '/football-players/{id}', name: 'app_football_player_show', requirements: ['id' => '\d+'])]
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

    #[Route(path: '/football-players/new', name: 'app_football_player_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isGranted('ROLE_ADMIN') && !$this->isGranted('ROLE_SUPER_ADMIN')) {
            throw $this->createAccessDeniedException('Access denied.');
        }

        $player = new FootballPlayer();
        $form = $this->createForm(FootballPlayerType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($player);
            $em->flush();

            $this->addFlash('success', 'Football Player added successfully.');
            return $this->redirectToRoute('app_football_players');
        }

        return $this->render('football_players/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/football-players/search', name: 'app_football_player_search')]
    public function search(Request $request, EntityManagerInterface $em): Response
    {
        $searchQuery = $request->query->get('searchQuery');
        if (!$searchQuery) {
            return $this->redirectToRoute('app_football_players');
        }

        $repository = $em->getRepository(FootballPlayer::class);
        $qb = $repository->createQueryBuilder('p');
        $qb->where($qb->expr()->orX(
            $qb->expr()->like('p.Name', ':searchQuery'),
            $qb->expr()->like('p.FirstName', ':searchQuery')
        ))
            ->setParameter('searchQuery', '%' . $searchQuery . '%');

        $players = $qb->getQuery()->getResult();
        return $this->render('football_players/search.html.twig', [
            'players' => $players,
            'searchQuery' => $searchQuery,
        ]);
    }


}
