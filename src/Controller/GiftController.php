<?php

namespace App\Controller;

use App\Entity\Itinerary;
use App\Form\ItineraryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/gift', name: 'gift_')]
class GiftController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {

    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        /*
        $repository = $this->entityManager->getRepository(Itinerary::class);
        $itineraries = $repository->findAll();*/
        return $this->render('gift/index.html.twig', [
            'controller_name' => 'GiftController',
            //'itineraries' => $itineraries
        ]);
    }

}
