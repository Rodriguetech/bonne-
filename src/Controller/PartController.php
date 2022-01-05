<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Form\DemType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartController extends AbstractController
{
    #[Route('/part', name: 'part')]
    public function index(Request $request): Response
    {
        // creer un formulaire
        $notification = null;
        $form = $this->createForm(DemType::class);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $fullname = $data['fullname'];
            $email = $data['email'];
            $message = $data['message'];
            $type = $data['type'];
            $devise = $data['devise'];
            $montant = $data['montant'];
            $dure = $data['dure'];
            $num = $data['numero'];
            $pays = $data['pays'];


            $hFullname = "Nom et prenom: <br>".$fullname ."<br>";
            $hEmail = "Email: <br>".$email ."<br>";
            $hType = "Type de demande: <br>".$type."<br>";
            $hMontant = "Montant : <br>".$montant."<br>";
            $hType = "Devise : <br>".$devise."<br>";
            $hDure = "Durée de remboursement : <br>".$dure."<br>";
            $hMessage = "Message: <br>".$message."<br>";
            $hNum = "Numero : <br>".$num. "<br>";
            $hPays = "Pays : <br>".$pays. "<br>";
           

            $mail = new Mail();

            $content = "les informations sont : <br><br>". $hFullname . "<br><br>" . $hEmail . "<br><br>" . $hMontant . "<br><br>" . $hType . "<br><br>" . $hDure . "<br><br>" . $hMessage ."<br><br>" .$hNum ."<br><br>". $hPays  ;
            
            $mail ->send("contact@bonnefoiefinance.com", "Nouvelle demande" , "BonneFoie finance" , $content);


            $notification = 'Votre message a bien été envoyé';
            unset($form);
            $form = $this->createForm(DemType::class);
        }

        return $this->render('part/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);

    }
}
