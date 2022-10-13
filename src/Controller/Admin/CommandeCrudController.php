<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id_membre'),
            IdField::new('id_produit'),
            IntegerField::new('quantite'),
            IntegerField::new('montant'),
            IdField::new('etat'),
            DateTimeField::new('createdAt')->setFormat("d/M/y à H:m:s"),
        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance->getId())
        {
          $entityInstance->setPassword(
            $this->hasher->hashPassword($entityInstance,$entityInstance->getPassword())
          );
            
        }


        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
       
    
}
