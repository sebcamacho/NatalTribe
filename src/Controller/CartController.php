<?php

namespace App\Controller;

use App\Entity\Creneau;
use App\Repository\CreneauRepository;
use App\Service\Cart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/mes-reservations', name: 'cart')]
    public function index( Cart $cart, CreneauRepository $creneauRepository): Response
    {
        $allResa = [];

        
        if($cart->get()){
        foreach($cart->get() as $id => $value){
            $creneau_object = $creneauRepository->findOneBy(['id' => $id]);

            if(!$creneau_object){
                $cart->delete($id);
                continue;
            }

            $allResa[] = [
                
                'creneau' => $creneau_object,
                'value' => $value
            ];
        }
        }
        
      
        return $this->render('cart/index.html.twig', [
            'cart' => $allResa
        ]);
    }

    #[Route('/cart/add/{id}', name: 'add_to_cart')]
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/remove', name: 'remove_my_cart')]
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('cart');
    }

    #[Route('/cart/delete/{id}', name: 'delete_to_cart')]
    public function delete($id, Cart $cart): Response
    {
        $cart->delete($id);
       
        return $this->redirectToRoute('cart');
    }
}
