<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'user_login')]
    public function index(): Response
    {
        return $this->render('user/login.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
