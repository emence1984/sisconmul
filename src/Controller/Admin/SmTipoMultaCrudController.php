<?php

namespace App\Controller\Admin;

use App\Entity\SmTipoMulta;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class SmTipoMultaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SmTipoMulta::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('descripcion', 'Tipo de Multa'),
            MoneyField::new('valor', 'Valor de la Multa')->setCurrency('USD')->setTextAlign('right'),
        ];
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the visible title at the top of the page and the content of the <title> element
            // it can include these placeholders: %entity_id%, %entity_label_singular%, %entity_label_plural%
            ->setPageTitle('index', 'Listado de Tipo de Multas Registradas:')

            ->setPageTitle('new', 'Crear un Tipo de Multa:')

            ->setDefaultSort(['descripcion' => 'DESC'])
        
            // in DETAIL and EDIT pages, the closure receives the current entity
            // as the first argument
            //->setPageTitle('edit', fn (SmUsuario $category) => sprintf('Editando <b>%s</b>', $category->getUsuario()))
            
            //->setPageTitle('detail', fn (Product $product) => (string) $product)
    
        ;
    }
    
}
