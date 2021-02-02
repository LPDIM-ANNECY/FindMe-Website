<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class ManageCustomersController extends AbstractController
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('manage/customers', name: 'manage_customers')]
    public function index(): Response
    {
        return $this->render('admin/manage-customers.html.twig', [
            'customers' => $this->userRepository->getAllCustomer()
        ]);
    }
}
