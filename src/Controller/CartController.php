<?php

namespace App\Controller;

use App\Entity\Product\FootballPlayer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route(path: '/cart', name: 'app_cart')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route(path: '/cart/add/{id}', name: 'app_cart_add')]
    public function add(Request $request, int $id, EntityManagerInterface $em): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        $product = $em->getRepository(FootballPlayer::class)->find($id);
        if (!$product) {
            $this->addFlash('error', 'Product not found.');
            return $this->redirectToRoute('app_cart');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product' => [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'firstName' => $product->getFirstName(),
                    'valueMoney' => $product->getValueMoney(),
                    'currentClub' => $product->getCurrentClub(),
                    'currentRole' => $product->getCurrentRole(),
                ],
                'quantity' => 1,
            ];
        }

        $session->set('cart', $cart);
        $this->addFlash('success', 'Product added to cart.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route(path: '/cart/remove/{id}', name: 'app_cart_remove')]
    public function remove(Request $request, int $id): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $session->set('cart', $cart);
            $this->addFlash('success', 'Product removed from cart.');
        } else {
            $this->addFlash('error', 'Product not found in cart.');
        }

        return $this->redirectToRoute('app_cart');
    }

    #[Route(path: '/cart/clear', name: 'app_cart_clear')]
    public function clear(Request $request): Response
    {
        $session = $request->getSession();
        $session->remove('cart');
        $this->addFlash('success', 'Cart cleared.');

        return $this->redirectToRoute('app_cart');
    }

    #[Route(path: '/cart/purchase', name: 'app_cart_purchase')]
    public function purchase(Request $request, EntityManagerInterface $em): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);

        if (empty($cart)) {
            $this->addFlash('error', 'Your cart is empty.');
            return $this->redirectToRoute('app_cart');
        }

        foreach ($cart as $id => $item) {
            $player = $em->getRepository(FootballPlayer::class)->find($id);
            if ($player) {
                $em->remove($player);
            }
        }

        $em->flush();
        $session->remove('cart');
        $this->addFlash('success', 'Purchase successful.');

        return $this->redirectToRoute('app_cart');
    }
}
