<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('description'),
            ChoiceField::new('couleur')->setChoices([
                'bleu'=>'bleu',
                'rouge'=>'rouge',
                'jaune'=>'jaune',

            ]),
            ChoiceField::new('taille')->setChoices([
                
                'S' => 's',
                'M' => 'm',
                'L' => 'l',
            ]),

            TextField::new('collection'),
            TextField::new('photo'),
            NumberField::new('prix'),
            NumberField::new('stock'),
            DateTimeField::new('createdAt')->setFormat("d/M/y à H:m:s")->hideOnForm(),
        ];
    }
    public function createEntity(string $entityFqcn)
{
    
$produit= new $entityFqcn;
$produit->setCreatedAt(new \DateTime);
return $produit;



}
    
}
