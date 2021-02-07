<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class ManageCustomersController extends AbstractController
{

    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/manage-customers', name: 'manage_customers')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user)
            ->remove('roles') // we do not manage the change of roles
            ->remove('password'); // we do not manage the change of password

        return $this->render('admin/manage-customers/index.html.twig', [
            'customers' => $this->userRepository->getAllCustomer(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/manage-customers/edit/{id}', name: 'edit_customer')]
    public function edit(User $user, Request $request) : Response
    {
        $form = $this->createForm(UserType::class, $user)
            ->remove('roles') // we do not manage the change of roles
            ->remove('password'); // we do not manage the change of password

        $form->handleRequest($request);

        //dd($form->isValid(), $form->getErrors(true));

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return new JsonResponse(['response' => 'OK']);
        }

        return $this->render('admin/manage-customers/edit.html.twig', [
            'form' => $form->createView(),
        ]);

        //return new JsonResponse(['response' => 'PAS OK', 'errors' => $form->getErrors(true)]);
    }
}
