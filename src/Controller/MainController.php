<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\Produit;
use App\Service\CartService;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('/main/profil', name: 'profil')]
    public function profil(CommandeRepository $repo)
    {
        $commandes = $repo->findBy(['id_Membre' => $this->getUser()]);

        return $this->render("main/profil.html.twig", [
            'commandes' => $commandes
        ]);
    }

    #[Route('/', name: 'app_root')]

    public function root()
    {
        // redirige simplement vers la page d'accueil
        return $this->redirectToRoute('app_main');
    }





    #[Route('/main/resa', name: 'resa')]
    public function resa(Produit $produit = null, EntityManagerInterface $manager, Request $rq,CartService $cs)
    {
        
     $cartWithData = $cs->getCardWithData();

     foreach($cartWithData As $item)
     {
        
    $commande = new Commande;
   
    $commande->setIdMembre($this->getUser());
    
    $commande->setCreatedAt(new \DateTime());

    $commande->setIdProduit($item['produit']);
    $commande->setEtat('en cours de traitement');
    $commande->setquantite($item['quantite']);
   $quantite=$item['quantite'];
   $prixunitaire=$item['produit']->getPrix();
   $montant=$quantite*$prixunitaire;



    $commande->setMontant($montant);
    
    

    

    $manager->persist($commande);
    $manager->flush();

}
           
    $this->addFlash('success', 'Votre commande a bien été enregistrée !');
     return $this->redirectToRoute('profil');
        }

      
    }

