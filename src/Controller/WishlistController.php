<?php

namespace App\Controller;

use App\Entity\Wishlist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WishlistRepository;

class WishlistController extends AbstractController
{
    #[Route('/addToWishList/{albumId}', name: 'addToWishList')]
    public function addToWishList(Request $request, EntityManagerInterface $entityManager, $albumId): Response
    {
        $uuid = $request->cookies->get('UUID');

        if (!$uuid) {
            // Handle the case where the UUID is not set, e.g., redirect to a login page or show an error
            return $this->redirectToRoute('homepage'); // Example redirection
        }

        // Assume $albumId is passed correctly and is the ID of the album. Adjust as needed.
        $wishlist = new Wishlist();
        $wishlist->setIdUser($uuid);
        $wishlist->setAlbumLink($albumId); // Adjust this line based on how you want to reference the album

        $entityManager->persist($wishlist);
        $entityManager->flush();

        // Redirect to a confirmation page or back to the album page with a success message
        return $this->redirectToRoute('home', ['success' => 'Album added to wishlist']);
    }

    #[Route('/wishlist', name: 'user_wishlist')]
    public function showUserWishlist(Request $request, WishlistRepository $wishlistRepository): Response
    {
        $uuid = $request->cookies->get('UUID');

        if (!$uuid) {
            // Handle case where UUID is not available, e.g., redirect to login or show an error message
            return $this->redirectToRoute('home'); // Example redirection
        }

        $wishlistItems = $wishlistRepository->findBy(['idUser' => $uuid]);

        return $this->render('wishlist.html.twig', [
            'wishlistItems' => $wishlistItems,
        ]);
    }
}
