<?php

declare(strict_types=1);

namespace App\Controller;

// Add LoggerInterface to the use statements at the top
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiConnection;

class HomePageController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    #[Route('/', name: 'home')]
    public function index(): Response {
        $albums = $this->getAlbums();
        return $this->render('home.html.twig', [
            'albums' => $albums,
        ]);
    }

    #[Route('/category/{categoryName}', name: 'album_category')]
    public function category(string $categoryName): Response {
        $albums = $this->getAlbums();
        $categoryAlbums = $albums[$categoryName] ?? [];
        $categories = array_keys($albums);

        return $this->render('category.html.twig', [
            'categoryName' => $categoryName,
            'albums' => $categoryAlbums,
            'categories' => $categories,
        ]);
    }

    private function getAlbums(): array {
        // Pass the logger to ApiConnection
        $apiConn = new ApiConnection($this->logger);
        return $apiConn->getAllFruitsAlbums();
    }
}
