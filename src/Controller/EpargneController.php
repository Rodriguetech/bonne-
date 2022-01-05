<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EpargneController extends AbstractController
{
    #[Route('/epargne', name: 'epargne')]
    public function index(): Response
    {
        return $this->render('epargne/index.html.twig', [
            'controller_name' => 'EpargneController',
        ]);
    }
}
