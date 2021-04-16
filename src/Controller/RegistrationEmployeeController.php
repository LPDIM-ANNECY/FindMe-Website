<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/manage-employee', name: 'manageEmployee_')]
class RegistrationEmployeeController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/create-account', name: 'createAccount')]
    public function index(Request $request): Response
    {
        $user = (new User())->setCompanyName('tmp');

        $form = $this->createForm(UserType::class, $user)
            ->remove('company_name')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Mot de pass de confirmation'],
            ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setCompanyName('tmp');

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $this->render('manageEmployee/createAccount.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
