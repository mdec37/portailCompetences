<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/register", name="register")
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface $passwordEncoder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // Encoder le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));

            $this->entityManager->persist($user);
            $this->entityManager->flush();

//            $message = (new TemplatedEmail())
//                ->from('admin@admin.local')
//                ->to('m.declerck@gmail.com')
//                ->subject('Inscription réussie')
//                ->htmlTemplate('mail/register.html.twig')
//                ->context([
//                              'user' => $user
//                          ])
//            ;
//            $mailer->send($message);

            return $this->redirectToRoute('home');
        }


        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
