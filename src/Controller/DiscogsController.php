<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ApiConnection;

class DiscogsController // extends AbstractController
{
    public function getTitlesForSearch(string $entree): array
    {
        $api = new ApiConnection();
        $titres = [];
        $response = $api->discogsSearch($entree);
        foreach ($response['results'] as $result) {
            $titres->add($result['title']);
        }
        return $titres;
    }
}