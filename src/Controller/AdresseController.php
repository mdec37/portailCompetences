<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Portrait;
use App\Entity\User;
use App\Form\AdresseType;
use App\Form\PortraitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdresseController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/adresse", name="adresse")
     */
    public function index(): Response
    {
        return $this->render('adresse/index.html.twig', [
            'controller_name' => 'AdresseController',
        ]);
    }


    /**
     * @Route("/{id}/newadresse", name="newadresse")
     * @param \Symfony\Component\HttpFoundation\Request $requeste
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $requeste, User $user): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($requeste);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresse = $form->getData();

            $this->entityManager->persist($adresse);
            $this->entityManager->flush();

            $user -> setAdresse($adresse);
            $this->entityManager->flush();

            return $this->redirectToRoute('profil');
        }


        return $this->render('adresse/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/newadresse/edit", name="editadresse")
     */
    public function edit(Adresse $adresse, Request $request)
    : Response {
        $form = $this->createForm(AdresseType::class, $adresse);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $adresse = $form->getData();

            $this->entityManager->persist($adresse);
            $this->entityManager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('adresse/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
