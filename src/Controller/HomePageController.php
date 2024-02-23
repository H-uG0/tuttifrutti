<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ApiConnection;

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
        $ApiConn= New ApiConnection();
        return getAllFruitsAlbums();
        
    }
}