<?php

namespace App\Controller;

use App\Repository\CreneauRepository;
use App\Service\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mon-panier', name: 'cart')]
    public function showDetailedCart( Cart $cart, CreneauRepository $creneauRepository): Response
    {
        
       
        $detailResa = [];

        foreach($cart->get('cart') as $id => $value){
            $detailResa[]=[
                'creneau' => $creneauRepository->find($id),
                'value' => $value
            ];
        }
        
        return $this->render('cart/index.html.twig', [
            'cart' => $detailResa
        ]);
    }

    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add($id, Cart $cart): Response
    {   if(array_key_exists($id, $cart->get())){
        $this->addFlash('warning', 'vous avez déjà ajouté ce créneau');
    }else{
        $cart->add($id);
        $this->addFlash("success", "La réservation a bien été ajoutée au panier");
        
    }
    return $this->redirectToRoute('cours');
    }

    #[Route('/cart/remove', name: 'remove_my_cart')]
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        $this->addFlash("success", "Les reservations ont bien été supprimées");
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/delete/{id}', name: 'delete_to_cart')]
    public function delete($id, Cart $cart): Response
    {
        $cart->delete($id);

        $this->addFlash("success", "La reservation a bien été supprimée");
       
        return $this->redirectToRoute('cart');
    }
    
}
