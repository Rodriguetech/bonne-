<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MobilitéController extends AbstractController
{
    #[Route('/mobilite', name: 'mobilite')]
    public function index(): Response
    {
        return $this->render('mobilité/index.html.twig');
    }
}
