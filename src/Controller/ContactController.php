<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Form\ContactType;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request): Response
    {
        $notification = null;
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nom = $form['nom']->getData();
            $prenom = $form['prenom']->getData();
            $email = $form['email']->getData();
            $message = $form['message']->getData();



            $notification = "Merci de nous avoir contacté. Notre équipe va vous répondre dans les meilleurs délais.";


            $mail = new Mail();
            $content = " Nom  et prénom du Client : " . $nom ." " .$prenom ."<br>" . " Email du client : " . $email ."<br>" . " Message du client : " .$message ;
            $mail->send("contact@bonnefoiefinance.com","Contact", 'Contact du client ', $content);
            
       
            unset($entity);
            unset($form);

            $form = $this->createForm(ContactType::class);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            "notification" => $notification
        ]);
    }
}
