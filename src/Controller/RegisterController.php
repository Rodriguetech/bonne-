<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/devenir-client', name: 'register')]
    public function index(Request $request , UserPasswordHasherInterface $encoder): Response
    {
        $notification = null;
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $search_uuid = $this->entityManager->getRepository(User::class)->findOneByUuid($user->getUuid());
            $search_email  = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());
            if (!$search_uuid && !$search_email) {
                $password = $encoder->hashPassword($user,$user->getPassword());
                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $mail = new Mail();
                $content = "Bonjour ".$user->getNom()."<br/>Bienvenue sur BonneFoie finance.<br><br/>Merci pour votre inscription vos informations seront évaluées .<br><br/> Après évaluation nous validerons votre compte ,Pour l'instant vous pouvez vous connectez <a style='color: #0d6efd;' href='https://bonnefoiefinance.com/connexion'>Cliqué ici</a>  ";
                $mail->send($user->getEmail(), $user->getNom(), 'Bienvenue sur BonneFoie finance', $content);

                unset($entity);
                unset($form);

                $user = new User();
                $form = $this->createForm(RegisterType::class, $user);

                $mail = new Mail();
                $content =  "Bonjour BonneFoie finance un nouveau client vient de s'inscrire";
                $mail->send("contact@bonnefoiefinance.com", 'Nouvelle', 'Client inscrire', $content);

                $notification = "Votre inscription s'est correctement déroulée. Vous pouvez dès à présent vous connecter à votre compte.";
            } else {
                $notification = "L'identifiant et l'email  que vous avez renseigné existe déjà";
            }
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
