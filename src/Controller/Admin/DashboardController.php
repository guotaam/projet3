<?php

namespace App\Controller\Admin;
use App\Entity\Produit;
use App\Entity\Membre;
use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BACKOFFICE');
    }

    public function configureMenuItems(): iterable
    {
        return[
            MenuItem::linkToDashboard('accueil', 'fa fa-home'),
            MenuItem::section('Produits'),
            MenuItem::linkToCrud('Produit','fas fa-newspaper',Produit::class),
            MenuItem::section('Membres'),
            MenuItem::linkToCrud('Membre','fas fa-newspaper',Membre::class),
            MenuItem::section('commandes'),
            MenuItem::linkToCrud('commandes','fas fa-newspaper',Commande::class)
        ];
        
    }
}
