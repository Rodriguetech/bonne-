<?php

namespace App\Controller;
use App\Entity\Temoignage;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        
          $temoignage = $this->entityManager->getRepository(Temoignage::class)->findAll();
        
        return $this->render('home/index.html.twig',array(
            'temoignage' => $temoignage,
        ));
    }
}
    // /**
    //  * @Route("/", name="home")
    //  */