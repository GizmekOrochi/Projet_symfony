<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SuperAdminController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    #[Route('/super-admin/users', name: 'super_admin_users')]
    public function listUsers(): Response
    {
        $users = $this->userRepository->findAll();
        return $this->render('super_admin/users.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/super-admin/delete/{id}', name: 'super_admin_delete_user')]
    public function deleteUser(int $id): Response
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            $this->addFlash('error', 'Utilisateur non trouvé.');
            return $this->redirectToRoute('super_admin_users');
        }
        $this->entityManager->remove($user);
        $this->entityManager->flush();
        $this->addFlash('success', 'Utilisateur supprimé avec succès.');
        return $this->redirectToRoute('super_admin_users');
    }

    #[Route('/super-admin/promote/{id}', name: 'super_admin_promote_user')]
    public function promoteUser(int $id): Response
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            $this->addFlash('error', 'Utilisateur non trouvé.');
            return $this->redirectToRoute('super_admin_users');
        }

        $roles = $user->getRoles();
        if (!in_array('ROLE_ADMIN', $roles, true)) {
            // Remove the CLIENT role if it exists.
            $roles = array_filter($roles, fn($role) => $role !== 'ROLE_CLIENT');
            // Add the ADMIN role.
            $roles[] = 'ROLE_ADMIN';
            $user->setRoles($roles);
            $this->entityManager->flush();
            $this->addFlash('success', 'Utilisateur promu au statut Admin.');
        } else {
            $this->addFlash('info', 'Cet utilisateur est déjà Admin.');
        }
        return $this->redirectToRoute('super_admin_users');
    }

    #[Route('/super-admin/demote/{id}', name: 'super_admin_demote_user')]
    public function demoteUser(int $id): Response
    {
        $user = $this->userRepository->find($id);
        if (!$user) {
            $this->addFlash('error', 'Utilisateur non trouvé.');
            return $this->redirectToRoute('super_admin_users');
        }
        $roles = $user->getRoles();
        if (in_array('ROLE_ADMIN', $roles, true)) {
            $roles = array_filter($roles, fn($role) => $role !== 'ROLE_ADMIN');
            if (!in_array('ROLE_CLIENT', $roles, true)) {
                $roles[] = 'ROLE_CLIENT';
            }
            $user->setRoles($roles);
            $this->entityManager->flush();
            $this->addFlash('success', 'Le statut Admin a été retiré et le rôle Client a été ajouté.');
        } else {
            $this->addFlash('info', 'Cet utilisateur n\'est pas Admin.');
        }
        return $this->redirectToRoute('super_admin_users');
    }
}
