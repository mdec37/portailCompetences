<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Entity\Portrait;
use App\Entity\User;
use App\Form\CompetencesType;
use App\Form\PortraitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetencesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/competences", name="competences")
     */
    public function index(): Response
    {
        return $this->render('competences/index.html.twig', [
            'controller_name' => 'CompetencesController',
        ]);
    }

    /**
     * @Route("/competences/{id}/new", name="newCompetences")
     */
//    id du user car nvlle competences
    public function new(Request $request, User $user)
    {
        $competences = new Competences();
        $form = $this->createForm(CompetencesType::class, $competences);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competences = $form->getData();
            $competences->setLienUser($user);
            $this->entityManager->persist($competences);
            $this->entityManager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render(
            'competences/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/competences/{id}/edit", name="editCompetences")
     */
//    id de la competence
    public function edit(Competences $competences, Request $request) : Response
    {
        $form = $this->createForm(CompetencesType::class, $competences);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $competences = $form->getData();

            $this->entityManager->persist($competences);
            $this->entityManager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render(
            'competences/index.html.twig',
            ['form' => $form->createView()]
        );
    }
}
