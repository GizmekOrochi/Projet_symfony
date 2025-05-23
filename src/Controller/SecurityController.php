<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CreateAccountType;
use App\Form\ModifyAccountType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SecurityController extends AbstractController
{
    #[Route(path: '/security/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route(path: '/security/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/security/create-account', name: 'app_create_account')]
    public function createAccount(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(CreateAccountType::class, $user);
        $form->add('submit', SubmitType::class, ['label' => 'Create Account']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUser = $em->getRepository(User::class)->findOneBy(['login' => $user->getLogin()]);
            if ($existingUser) {
                $this->addFlash('error', 'The login is already in use. Please choose a different one.');
                return $this->render('security/create_account.html.twig', [
                    'myform' => $form->createView(),
                ]);
            }
            $user->setRoles(['ROLE_CLIENT']);
            // Hash the password provided in the form
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Account created successfully!');
            return $this->redirectToRoute('app_login');
        }

        if ($form->isSubmitted()) {
            $this->addFlash('error', 'There were errors in your submission.');
        }

        return $this->render('security/create_account.html.twig', [
            'myform' => $form->createView(),
        ]);
    }

    #[Route(path: '/security/edit-account', name: 'app_edit_account')]
    public function editAccount(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(ModifyAccountType::class, $user);
        $form->add('submit', SubmitType::class, ['label' => 'Update Account']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->get('password')->getData();
            if ($newPassword) {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
            }
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Account updated successfully!');
            return $this->redirectToRoute('app_accueil');
        }

        if ($form->isSubmitted()) {
            $this->addFlash('error', 'There were errors in your submission.');
        }

        return $this->render('security/edit_account.html.twig', [
            'myform' => $form->createView(),
        ]);
    }
}
