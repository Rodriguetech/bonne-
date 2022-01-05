<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SanteController extends AbstractController
{
    #[Route('/sante', name: 'sante')]
    public function index(): Response
    {
        return $this->render('sante/index.html.twig');
    }
}
