<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\HttpFoundation\Request;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $repository = $this->entityManager->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);
    }

    #[Route('/add', name: 'add')]
    public function addCategory(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $this->isGranted('ROLE_USER')) {
            $category = $form->getData();

            $this->entityManager->persist($category);
            $this->entityManager->flush();

            $this->addFlash('success', 'Catégorie crée');
            return $this->redirectToRoute('category_read', ["id" => $category->getId()]);
        }

        return $this->render('category/add.html.twig', ['controller_name' => 'CategoryController',
            'form' => $form->createView()]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function deleteCategory(Category $category): Response
    {
        $toDeleteCategory = $this->entityManager->getRepository(Category::class)->find($category->getId());

        $this->entityManager->remove($toDeleteCategory);
        $this->entityManager->flush();

        return $this->redirect("/category");
    }

    #[Route('/{id}', name: 'read')]
    public function getCategory(Category $category): Response
    {
        return $this->render('category/category.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category
        ]);
    }
}
