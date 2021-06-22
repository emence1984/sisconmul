<?php

namespace App\Controller\Admin;

use App\Entity\SmRegistroMulta;
use App\Entity\SmUsuario;
use App\Form\RegistroDetalleMultaType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;


class SmRegistroMultaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SmRegistroMulta::class;
    }

   // private $security;

 /*   public function __construct(Security $security)
    {
        $this->security = $security;
    }*/
    
    public function configureFields(string $pageName): iterable
    {

       // $user = $this->security->getUser();

        //$fechaActual = new Date();

        return [
            //IdField::new('id'),
            FormField::addPanel('Registro de Multas'),

           // TextField::new('fechaRegistroTexto', 'Fecha Registro')->hideOnIndex(), //->setFormat('dd/MMMM/yyyy'),
            //Field::new('fechaRegistroTexto', 'Fecha Registro')->hideOnIndex(),
            
            DateField::new('fechaRegistro', 'Fecha de Registro')->setFormat('dd/MMMM/yyyy')->hideOnForm(),

            TextField::new('detalle', 'Detalle'),
           
            //AssociationField::new('smUsuario', 'Usuario Registro') ->hideOnIndex(),
            
            TextField::new('nombreUsuario', 'Usuario Registro') ->hideOnForm(),

            CollectionField::new('smRegistroMultaDetalles','Cant. Multas')->setTextAlign('right')
            ->setEntryType(RegistroDetalleMultaType::class),
            
            MoneyField::new('valorTotalMulta', 'Total Generado')->setCurrency('USD')->setTextAlign('right')->hideOnForm(),

            IntegerField::new('cantidadlMultaNoPagada', 'Cant. No Pagadas')->setTextAlign('right')->hideOnForm(),
            
            MoneyField::new('valorTotalMultaPorCobrar', 'Total Por Cobrar')->setCurrency('USD')->setTextAlign('right')->hideOnForm(),

           // ->hideOnIndex(),

        ];
    }
    

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createEntity(string $entityFqcn)
    {
        // tratar de recuperar el usuario logoneado para asignar al registro
        //$this->getUser();
        
        // hay que capturar el usuario logoneado para buscarlo

        $userSession = $this->getUser();
        
        //die($userSession->getUsuario());

        $usuario = $this->entityManager ->getRepository(SmUsuario::class) -> loadUserByUsername($userSession->getUsuario());
       

        //$usuario = new SmUsuario();
       // $daoUsuario = new SmUsuarioRepository($entityFqcn);

        //$usuario -> setUsuario('0924544836');
        $fechaActual = new DateTime();

        $multa = new SmRegistroMulta();
        $multa-> setSmUsuario($usuario);
        $multa -> setFechaRegistro($fechaActual);

        return $multa;
    }



    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the visible title at the top of the page and the content of the <title> element
            // it can include these placeholders: %entity_id%, %entity_label_singular%, %entity_label_plural%
            ->setPageTitle('index', 'Listado de Multas Registrados:')

            ->setPageTitle('new', 'Crear una multa:')

            ->setDefaultSort(['fechaRegistro' => 'DESC'])
        
            // in DETAIL and EDIT pages, the closure receives the current entity
            // as the first argument
            //->setPageTitle('edit', fn (SmUsuario $category) => sprintf('Editando <b>%s</b>', $category->getUsuario()))
            
            //->setPageTitle('detail', fn (Product $product) => (string) $product)
    
        ;
    }
    
}
