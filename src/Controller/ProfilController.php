<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Categories;
use App\Entity\Competences;
use App\Entity\User;
use App\Form\AdresseType;
use App\Form\UserType;
use App\Repository\CompetencesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, CompetencesRepository $CompetencesRepository){
        $this -> entityManager = $entityManager;
        $this -> userRepository = $userRepository;
        $this -> CompetencesRepository = $CompetencesRepository;

    }

    /**
     * @Route("/profil", name="profil")
     */
    public function index(): Response
    {
        $user = $this->entityManager->getRepository(User::class)->findAll();
        $competences = $this->entityManager->getRepository(Competences::class)->findAll();
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'user' => $user,
            'competences' => $competences,
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/profil/show", name="show")
     */
    public function show(): Response
    {
        $user = $this->entityManager->getRepository(User::class)->findAll();
        $competences = $this->entityManager->getRepository(Competences::class)->findAll();
        $categories = $this->entityManager->getRepository(Categories::class)->findAll();

        return $this->render('profil/show.html.twig', [
            'controller_name' => 'ProfilController',
            'user' => $user,
            'userListe' => $this->userRepository->findAll(),
            'competences' => $competences,
            'categories' => $categories,
        ]);
    }


    /**
     * @Route("/register/{id}/edit", name="editprofil")
     */
    public function edit(User $profil, UserPasswordEncoderInterface $passwordEncoder, Request $request)
    : Response {
        $form = $this->createForm(UserType::class, $profil);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $profil = $form->getData();

            // Encoder le mot de passe
            $profil->setPassword($passwordEncoder->encodePassword($profil, $profil->getPassword()));

            $this->entityManager->persist($profil);
            $this->entityManager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render(
            'register/index.html.twig',
            ['form' => $form->createView()]
        );
    }


}
