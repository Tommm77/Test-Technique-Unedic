<?php

namespace App\Controller\Admin;

use App\Entity\Student;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(StudentCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()->setTitle('Website');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Student');

        yield MenuItem::subMenu('Actions', 'fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Show Student', 'fas fa-eye', Student::class),
            MenuItem::linkToCrud('Add Student', 'fas fa-plus', Student::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Edit Student', 'fas fa-edit', Student::class)->setAction(Crud::PAGE_EDIT),
            
        ]);


    }
}