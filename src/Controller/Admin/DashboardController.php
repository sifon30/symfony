<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\Student;
use App\Entity\Borrowing;
use App\Entity\Book;
use App\Entity\Author;
use App\Entity\User;


use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         return $this->redirect($adminUrlGenerator->setController(StudentCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new() 
        ->setTitle('<img src="{{asset(img/book.png)}}" class="img-fluid d-block mx
 auto" style="max-width:100px; width:100%;"><h2 class="mt-3 fw-bold text-white 
 text-center">Librarian</h2>');
    }
  
   
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home'); 
        yield MenuItem::linkToCrud('Student', 'fas fa-chalkboard-teacher', Student::class); 
        yield MenuItem::linkToCrud('Borrowing', 'fas fa-book-reader', Borrowing::class); 
        yield MenuItem::linkToCrud('Book', 'fas fa-book', Book::class); 
        yield MenuItem::linkToCrud('Author', 'fas fa-book-reader', Author::class); 
        yield MenuItem::linkToCrud('User', 'fa-solid fa-user', User::class); 

    } 
    #[Route('/admin_borrowing', name: 'admin_borrowing')] 
public function index2(): Response 
{ 
$routeBuilder = $this->container->get(AdminUrlGenerator::class); 
$url = $routeBuilder->setController(BorrowingCrudController::class)->generateUrl(); 

return $this->redirect($url); 
// return parent::index(); 
} 
#[Route('/admin_book', name: 'admin_book')] 
public function index3(): Response 
{ 
$routeBuilder = $this->container->get(AdminUrlGenerator::class); 
$url = $routeBuilder->setController(BookCrudController::class)->generateUrl(); 

return $this->redirect($url); 
// return parent::index(); 
} 
#[Route('/admin_author', name: 'admin_author')] 
public function index4(): Response 
{ 
$routeBuilder = $this->container->get(AdminUrlGenerator::class); 
$url = $routeBuilder->setController(AuthorCrudController::class)->generateUrl(); 

return $this->redirect($url); 
// return parent::index(); 
} 
#[Route('/admin_user', name: 'admin_user')] 
public function index5(): Response 
{ 
$routeBuilder = $this->container->get(AdminUrlGenerator::class); 
$url = $routeBuilder->setController(UserCrudController::class)->generateUrl(); 

return $this->redirect($url); 
// return parent::index(); 
}
}