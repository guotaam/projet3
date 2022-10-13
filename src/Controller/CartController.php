<?php

namespace App\Controller;
use App\Service\CartService;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
       #[Route('/cart', name: 'app_cart')]
        public function index(CartService $cs): Response
        {
           $cartWithData = $cs->getCardWithData();
           $total = $cs->getTotal();
    
            return $this->render('cart/index.html.twig', [
                'items' => $cartWithData,
                'total'=>$total
            ]);
        }
    
        #[Route('/carte/add/{id}', name: 'cart_add')]
        public function add($id,CartService $cs): Response
        {
           $cs->add($id);
           return $this->redirectToRoute('app_cart');
        }
    
        #[Route('/carte/remove/{id}', name: 'cart_remove')]
        public function remove($id,CartService $cs)
        {
            $cs->remove($id);
            return $this->redirectToRoute('app_cart');
          
        }
    
    }
    
    

