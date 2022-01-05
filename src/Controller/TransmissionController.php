<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TransmissionController extends AbstractController
{
    #[Route('/transmission', name: 'transmission')]
    public function index(): Response
    {
        return $this->render('transmission/index.html.twig');
    }


    #[Route('/transmission/code', name: 'transmission_code')]
    public function tr(): Response
    {
        return $this->render('transmission/tr.html.twig');
    }


    #[Route('/transmission/code/mess', name: 'transmission_mess')]
    public function mess(): Response
    {
        return $this->render('transmission/mess.html.twig');
    }

}
