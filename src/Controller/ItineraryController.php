<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItineraryController extends AbstractController
{
    #[Route('/itinerary', name: 'itinerary')]
    public function index(): Response
    {
        return $this->render('itinerary/index.html.twig', [
            'controller_name' => 'ItineraryController',
        ]);
    }
}
