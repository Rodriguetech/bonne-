<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProController extends AbstractController
{
    #[Route('/pro', name: 'pro')]
    public function index(): Response
    {
        return $this->render('pro/index.html.twig', [
            'controller_name' => 'ProController',
        ]);
    }
}
