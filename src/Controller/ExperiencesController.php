<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Entity\Experiences;
use App\Entity\User;
use App\Form\CompetencesType;
use App\Form\ExperiencesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperiencesController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/experiences", name="experiences")
     */
    public function index(): Response
    {
        return $this->render('experiences/index.html.twig', [
            'controller_name' => 'ExperiencesController',
        ]);
    }

    /**
     * @Route("/experiences/{id}/new", name="newExperiences")
     */
//    id du user car nvlle competences
    public function new(Request $request, User $user)
    {
        $experiences = new Experiences();
        $form = $this->createForm(ExperiencesType::class, $experiences);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experiences = $form->getData();
            $experiences->setUser($user);
            $this->entityManager->persist($experiences);
            $this->entityManager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render(
            'experiences/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/experiences/{id}/edit", name="editExperiences")
     */
//    id de la competence
    public function edit(Experiences $experiences, Request $request) : Response
    {
        $form = $this->createForm(ExperiencesType::class, $experiences);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $experiences = $form->getData();

            $this->entityManager->persist($experiences);
            $this->entityManager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render(
            'experiences/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
