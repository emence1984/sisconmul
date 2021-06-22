<?php

namespace App\Controller\Admin;

use App\Entity\SmUsuario;
use App\Entity\VwMultasRegistradas;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;

use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class VwMultasRegistradasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VwMultasRegistradas::class;
    }

 
    public function configureFields(string $pageName): iterable
    {
        return [

            DateField::new('fechaAplicacion', 'Fecha')->setFormat('dd/MMMM/yyyy'),

            TextField::new('tipoMulta', 'Tipo de Multa'),

            TextField::new('detalle', 'Detalle Multa'),

            TextField::new('observacion', 'Observación'),

            MoneyField::new('valor', 'Valor')->setCurrency('USD')->setTextAlign('right'),

           // TextField::new('nombreCompleto', 'Nombre')->hideOnForm(),

            TextField::new('pagado', 'Pagada ?'),
        ];
    }
    


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the visible title at the top of the page and the content of the <title> element
            // it can include these placeholders: %entity_id%, %entity_label_singular%, %entity_label_plural%
            ->setPageTitle('index', 'Listado de Multas Registradas:')

            //->setPageTitle('new', 'Crear una multa:')

            ->setDefaultSort(['fechaAplicacion' => 'DESC'])
        
            ->setSearchFields(null)
    
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // Elimina los botones de nuevo, editar y eliminar
            // ya que solo es para fines de consulta
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
           
        ;
    }

  

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    
    
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        
        $userSession = $this->getUser();
        
        $qb = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);

        if($userSession!=null){
   
            $usuario = $this->entityManager ->getRepository(SmUsuario::class) -> loadUserByUsername($userSession->getUsuario());
            $qb->andWhere('entity.identificacion = :identificacion');
            $qb->setParameter('identificacion', $usuario->getSmPersona()->getIdentificacion());
    
        }
        

        return $qb;
    }

 

  public function configureFilters(Filters $filters): Filters
    {
        
        return $filters
            ->add(ChoiceFilter::new('pagado', 'Solo Pagadas ?')
            ->setChoices(['SI' => 'SI',
                          'NO' => 'NO'] ))
            
            ->add(EntityFilter::new('smTipoMulta','Tipo de Multa'))
           
                
        ;
    }

    
}
