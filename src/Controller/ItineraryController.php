<?php

namespace App\Controller;

use App\Entity\Itinerary;
use App\Form\ItineraryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/itinerary', name: 'itinerary_')]
class ItineraryController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $repository = $this->entityManager->getRepository(Itinerary::class);
        $itineraries = $repository->findAll();
        return $this->render('itinerary/index.html.twig', [
            'controller_name' => 'ItineraryController',
            'itineraries' => $itineraries
        ]);
    }

    #[Route('/add', name: 'add')]
    function addItinerary(Request $request){
        $form = $this->createForm(ItineraryType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $this->isGranted('ROLE_USER')) {
            $itinerary = $form->getData();

            $this->entityManager->persist($itinerary);
            $this->entityManager->flush();

            $this->addFlash('success', 'Itinéraire crée');
            return $this->redirectToRoute('itinerary_read', ["id" => $itinerary->getId()]);
        }

        return $this->render('itinerary/add.html.twig', ['controller_name' => 'ItineraryController',
            'form' => $form->createView()]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deletePlace(Itinerary $itinerary){
        $toDeletePlace = $this->entityManager->getRepository(Itinerary::class)->find($itinerary->getId());

        $this->entityManager->remove($toDeletePlace);
        $this->entityManager->flush();

        return $this->redirect("/itinerary");
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function editPlace(Itinerary $itinerary, Request $request): Response
    {
        $form = $this->createForm(ItineraryType::class, $itinerary);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $this->isGranted('ROLE_USER')) {
            $formItinerary = $form->getData();

            $this->entityManager->persist($formItinerary);
            $this->entityManager->flush();

            $this->addFlash('success', 'Itineraire mise à jour');
            return $this->redirectToRoute('itinerary_read', ["id" => $formItinerary->getId()]);
        }

        return $this->render('itinerary/edit.html.twig', ['controller_name' => 'ItineraryController',
            'form' => $form->createView(),
            'itinerary' => $itinerary]);
    }

    #[Route('/{id}', name: 'read')]
    function getItinerary(Itinerary $itinerary){
        return $this->render('itinerary/itinerary.html.twig', [
            'controller_name' => 'ItineraryController',
            'itinerary' => $itinerary
        ]);
    }
}
