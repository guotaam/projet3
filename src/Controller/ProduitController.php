<?php

namespace App\Controller;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(ProduitRepository $repo): Response
    {
         
        return $this->render('produit/home.html.twig', [
        
        ]);
    }

    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $repo): Response
    {
        $produits=$repo->findAll(); 
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'produits'=>$produits
        ]);
    }

    #[Route('/produit/show/{id}', name: 'produit_show')]
    public function show($id, ProduitRepository $repo, Request $globals, EntityManagerInterface $manager): Response
    //$id correspondant au {id} dans l'URL
    {
        $produit=$repo->find($id);
        //find() permet de récupérer l'article en fonction de son id

       
                   return $this->render('produit_show', [
                'id'=> $produit->getId()
            ]);
     }
       
        
    }

