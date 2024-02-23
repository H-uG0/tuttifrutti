<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $albums = $this->getAlbums();
        return $this->render('home.html.twig', [
            'albums' => $albums,
        ]);
    }

    #[Route('/category/{categoryName}', name: 'album_category')]
    public function category(string $categoryName): Response
    {
        $albums = $this->getAlbums();
        $categoryAlbums = $albums[$categoryName] ?? [];
        $categories = array_keys($albums);

        return $this->render('category.html.twig', [
            'categoryName' => $categoryName,
            'albums' => $categoryAlbums,
            'categories' => $categories,
        ]);
    }
   
    // You might want to extract the albums fetching logic into its own method
// or service if you haven't already, to avoid code duplication.
    private function getAlbums(): array // à mettre dans le modele ou le repository
    {
        // This method should return the albums array as shown previously
        // Replace this with your actual data fetching logic
        return [
            'category1' => [
                ['id'=> '1','nom' => 'Album 1', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 1', 'styles' => ['Pop', 'Rock'], 'sortie' => '2021', 'label' => 'Label 1'],
                ['id'=> '2','nom' => 'Album 2', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 2', 'styles' => ['Jazz'], 'sortie' => '2020', 'label' => 'Label 2'],
                ['id'=> '3','nom' => 'Album 1', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 1', 'styles' => ['Pop', 'Rock'], 'sortie' => '2021', 'label' => 'Label 1'],
                ['id'=> '4','nom' => 'Album 2', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 2', 'styles' => ['Jazz'], 'sortie' => '2020', 'label' => 'Label 2'],
                ['id'=> '5','nom' => 'Album 1', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 1', 'styles' => ['Pop', 'Rock'], 'sortie' => '2021', 'label' => 'Label 1'],
                ['id'=> '6','nom' => 'Album 2', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 2', 'styles' => ['Jazz'], 'sortie' => '2020', 'label' => 'Label 2'],
                ['id'=> '7','nom' => 'Album 1', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 1', 'styles' => ['Pop', 'Rock'], 'sortie' => '2021', 'label' => 'Label 1'],
                ['id'=> '8','nom' => 'Album 2', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 2', 'styles' => ['Jazz'], 'sortie' => '2020', 'label' => 'Label 2'],
                ['id'=> '9','nom' => 'Album 1', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 1', 'styles' => ['Pop', 'Rock'], 'sortie' => '2021', 'label' => 'Label 1'],
                ['id'=> '10','nom' => 'Album 2', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 2', 'styles' => ['Jazz'], 'sortie' => '2020', 'label' => 'Label 2'],
            ],
            'category2' => [
                ['id'=> '11','nom' => 'Album 3', 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => 'Artist 3', 'styles' => ['Electronic'], 'sortie' => '2019', 'label' => 'Label 3'],
            ],
            // Add more categories and albums as needed
        ];
    }
}