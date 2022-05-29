<?php

namespace App\Controller;

use App\Repository\CreneauRepository;
use App\Service\Cart;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookingController extends AbstractController
{
    #[Route('/reservation', name: 'book')]
    public function index(Cart $cart, CreneauRepository $creneauRepository): Response
    {
    \Stripe\Stripe::setApiKey('sk_test_51Kn26dELYcHs36RPw2341teez27RHJL2Xw0sH2DVySqy5oPHgTqQNKn4htF99SoLpuY0dQZoMIxsI4Yly5dod9p600HJxkKc3o');

    $YOUR_DOMAIN = 'https://127.0.0.1:8000';

    $product_for_stripe = [];

    foreach($cart->getDetailedCart() as $id => $value){
      $product_for_stripe[] = [
        'creneau' => $creneauRepository->find($id),
        'value' => $value
      ];
    }
    dd($product_for_stripe);
    foreach($product_for_stripe as $detail){
      $name = $detail->getCreneau()->getCours()->getNom();
      dd($name);
    }

    $checkout_session = Session::create([
  'line_items' => [[
      'price_data' => [
        'currency' => 'eur',
        'product_data' => [
          'name' => 'T-shirt',
        ],
        'unit_amount' => 2000,
      ],
      'quantity' => 1,
    ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

// header("HTTP/1.1 303 See Other");
// header("Location: " . $checkout_session->url);

    dump($checkout_session->id);
    dd($checkout_session);

        return $this->render('book/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
