<?php

namespace App\Controller\Admin;

use App\Entity\SmPersona;
use App\Entity\SmRegistroMulta;
use App\Entity\SmTipoMulta;
use App\Entity\SmUsuario;
use App\Entity\VwMultasRegistradas;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="dashboard")
     */
    public function index(): Response
    {
        //return parent::index();

        //return $this->render('base.html.twig');

        if (!$this->getUser()) {
          return $this->redirectToRoute('login');
        }


        return $this->render('@EasyAdmin/welcome.html.twig', [
            'dashboard_controller_filepath' => (new \ReflectionClass(static::class))->getFileName(),
            'dashboard_controller_class' => (new \ReflectionClass(static::class))->getShortName(),
        ]);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sistema de Control de Multas');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Parámetros')->setPermission('ROLE_ADMIN');

        yield MenuItem::linkToCrud('Tipos de Multas', 'fas fa-file-signature', SmTipoMulta::class)->setPermission('ROLE_ADMIN');
        
        yield MenuItem::linkToCrud('Registro de Usuarios', 'fas fa-user-shield', SmUsuario::class)->setPermission('ROLE_ADMIN'); 

        yield MenuItem::section('Ingresos')->setPermission('ROLE_ADMIN');

        yield MenuItem::linkToCrud('Registro de Personas', 'fas fa-id-badge', SmPersona::class)->setPermission('ROLE_ADMIN');
       
        yield MenuItem::linkToCrud('Registro de Multas', 'fas fa-list', SmRegistroMulta::class)->setPermission('ROLE_ADMIN');
       
        yield MenuItem::section('');
        
        yield MenuItem::linkToCrud('Mis Multas', 'fas fa-list', VwMultasRegistradas::class)->setPermission( 'ROLE_USER');
        yield MenuItem::linkToCrud('Mis Multas', 'fas fa-list', VwMultasRegistradas::class)->setPermission( 'ROLE_ADMIN');

        yield MenuItem::section('');

        yield MenuItem::linkToLogout('Salir', 'fas fa-door-open');

    }


   

}
