<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\Competences;
use App\Entity\Entreprises;
use App\Entity\Experiences;
use App\Entity\User;
use App\Repository\CompetencesRepository;
use App\Repository\UserRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private UserRepository $userRepository;
    private CompetencesRepository $CompetencesRepository;
    public function __construct(UserRepository $userRepository, CompetencesRepository $CompetencesRepository){
        $this -> userRepository = $userRepository;
        $this -> CompetencesRepository = $CompetencesRepository;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()->getRepository(Categories::class)->count([]);
        $users = $this->getDoctrine()->getRepository(User::class)->count([]);
        $competences = $this->getDoctrine()->getRepository(Competences::class)->count([]);
        $entreprises = $this->getDoctrine()->getRepository(Entreprises::class)->count([]);
        $experiences = $this->getDoctrine()->getRepository(Experiences::class)->count([]);

        return $this->render('/dashboard/dashboard.html.twig', [
            'categories' => $categories,
            'users' => $users,
            'competences' => $competences,
            'experiences' => $experiences,
            'competencesAll' => $this -> CompetencesRepository -> findAll(),

            'entreprises' => $entreprises,

            'allUser' => $this->userRepository->findByRequete(),
            'userListe' => $this->userRepository->findAll(),
            'lastUser' => $this->userRepository->findLastUser()
        ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/main.css');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ECF SYMFONY');
    }

    public function configureMenuItems(): iterable
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

//        yield MenuItem::linkToCrud('Mon profil administrateur', 'fa fa-user', User::class)
//            ->setAction('detail')
//            ->setEntityId($user->getId());

        yield MenuItem::linkToCrud('Gestion des utilisateurs', 'fas fa-user', User::class);

        yield MenuItem::linkToCrud('Gestion des compétences', 'fas fa-list', Competences::class);

        yield MenuItem::linkToCrud('Gestion des expériences', 'fas fa-list', Experiences::class);


//        yield MenuItem::linkToCrud('Gérer mes compétences', 'fa fa-user', User::class)
//            ->setAction('edit')
//            ->setEntityId($user->getId())
//            ->setPermission("ROLE_COLLABORATEUR");
//        yield MenuItem::linkToCrud('Gestion des catégories', 'fas fa-list', Categories::class)
//            ->setPermission("ROLE_ADMIN");
//        yield MenuItem::linkToCrud('Gestion des entreprises', 'fas fa-list', Entreprises::class)
//            ->setPermission("ROLE_ADMIN");
    }

//    public function configureAssets(): Assets
//    {
//        return Assets::new()->addCssFile('../../assets/styles/css/admin.css');
//    }


}
