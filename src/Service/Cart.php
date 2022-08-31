<?php

namespace App\Service;

use App\Repository\CreneauRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    protected $session;
    protected $creneauRepository;

    public function __construct(SessionInterface $session, CreneauRepository $creneauRepository)
    {
        $this->session = $session;
        $this->creneauRepository = $creneauRepository;
    }

    public function add($id)
    {
        $cart = $this->session->get('cart', []);

        if(empty($cart[$id])){
            $cart[$id] = true;
        }

        $this->session->set('cart', $cart);
    }

    public function empty(){
        $this->add([]);
    }

    public function get(){

        return $this->session->get('cart', []);
    }

    /**
     * @return Creneau['creneau']
     */
    public function getDetailedCart(){
        $detailedCart = [];

        foreach($this->session->get('cart') as $id => $value){
        $booking = $this->creneauRepository->find($id);

        $detailedCart[] = [
            'creneau' => $booking,
            'value' => $value
        ];
        };
        return $detailedCart;
    }

    public function remove()
    {
        return $this->session->remove('cart');
    }

    public function delete($id)
    {
        $cart =$this->session->get('cart', []);

        unset($cart[$id]);
        

        return $this->session->set('cart', $cart);
    }
    
}