<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//prefixe de route
#[Route('/category', name: 'category_')]

class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
       

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    //#[Route ('/show/{category_name}', name : 'show')]
    #[Route('/{id<^[0-9]+$>}',requirements: ['id'=>'\d+'], methods: ['GET'], name: 'show')]
    public function show(int $id ,CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $category = $categoryRepository->findOneBy(['id' => $id]);
        
        $programs = [];
        if (!$category) {
            throw $this->createNotFoundException(
                'No category with name: '.$id.' found in category\'s table.'
            );
        } else {
            $programs = $programRepository->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3);
            
        }
        
        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs,
        ]);
    }
}
