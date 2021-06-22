<?php

namespace App\Controller\Admin;

use App\Entity\SmPersona;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class SmPersonaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SmPersona::class;
    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('identificacion','Número de Identificación')->setMaxLength(10),
            TextField::new('nombre', 'Nombres'),
            TextField::new('apellido', 'Apellidos'),
            EmailField::new('email', 'Correo Electrónico'),
            TextField::new('telefono', 'Teléfono de Contacto'),
        ];
    }
    

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the visible title at the top of the page and the content of the <title> element
            // it can include these placeholders: %entity_id%, %entity_label_singular%, %entity_label_plural%
            ->setPageTitle('index', 'Listado de Personas Registradas:')

            ->setPageTitle('new', 'Crear una Persona:')

            ->setDefaultSort(['apellido' => 'DESC'])
        
            // in DETAIL and EDIT pages, the closure receives the current entity
            // as the first argument
            //->setPageTitle('edit', fn (SmUsuario $category) => sprintf('Editando <b>%s</b>', $category->getUsuario()))
            
            //->setPageTitle('detail', fn (Product $product) => (string) $product)
    
        ;
    }
}
