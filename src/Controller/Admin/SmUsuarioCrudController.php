<?php

namespace App\Controller\Admin;

use App\Entity\SmUsuario;

use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;




class SmUsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SmUsuario::class;
    }

    public function configureFields(string $pageName): iterable
    {
      
        return [
            //IdField::new('id'),
            FormField::addPanel('Creación de Usuarios'),
            
            TextField::new('usuario', 'Usuario del Sistema'),
            //TextField::new('clave','Clave')->setFormType(PasswordType::class)->hideOnIndex(),
             
            Field::new('plainPassword', 'New password')->onlyOnForms()
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Ingrese la Clave:'],
                    'second_options' => ['label' => 'Repita la Clave:'],
                ]),


            ChoiceField::new('tipo', 'Tipo de Usuario')
                      ->setChoices(['Administrador' => 'A',
                                    'Usuario' => 'U']
            )->hideOnIndex(),

            AssociationField::new('smPersona', 'Persona Asociada'),

            TextField::new('tipoDescripcion', 'Tipo de Usuario')->hideOnForm(),
            
            TextField::new('nombrePersona', 'Persona Relacionada')->hideOnForm(),

        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the visible title at the top of the page and the content of the <title> element
            // it can include these placeholders: %entity_id%, %entity_label_singular%, %entity_label_plural%
            ->setPageTitle('index', 'Listado de Usuarios Registrados:')

            ->setPageTitle('new', 'Crear un Usuario:')

            ->setDefaultSort(['usuario' => 'DESC'])
        
            // in DETAIL and EDIT pages, the closure receives the current entity
            // as the first argument
            //->setPageTitle('edit', fn (SmUsuario $category) => sprintf('Editando <b>%s</b>', $category->getUsuario()))
            
            //->setPageTitle('detail', fn (Product $product) => (string) $product)
    
        ;
    }

    #####################################################

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;


    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);

        $this->addEncodePasswordEventListener($formBuilder);

        return $formBuilder;
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);

        $this->addEncodePasswordEventListener($formBuilder);

        return $formBuilder;
    }

    /**
     * @required
     */
    public function setEncoder(UserPasswordEncoderInterface $passwordEncoder): void
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function addEncodePasswordEventListener(FormBuilderInterface $formBuilder)
    {
        $formBuilder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            /** @var SmUsuario $user */
            $user = $event->getData();
            if ($user->getPlainPassword()) {
                $user->setClave($this->passwordEncoder->encodePassword($user, $user->getPlainPassword()));
            }
        });
    }




    ###############################################################################
    protected function prePersistUserEntity(SmUsuario $user)
    {
        $encodedPassword = $this->encodePassword($user, $user->getPassword());
        $user->setClave($encodedPassword);
    }

    protected function preUpdateUserEntity(SmUsuario $user)
    {
        if (!$user->getPlainPassword()) {
            return;
        }
        $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());
        $user->setClave($encodedPassword);
    }

    private function encodePassword($user, $password)
    {
        $passwordEncoderFactory = $this->get('security.encoder_factory');
        $encoder = $passwordEncoderFactory->getEncoder($user);
        return $encoder->encodePassword($password, $user->getSalt());
    }


}
