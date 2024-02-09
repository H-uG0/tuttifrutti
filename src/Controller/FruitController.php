<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FruitController extends AbstractController
{
    //return le json de la liste de fruit prédéfini
    public function getListeFruit() : array{
        $cheminJson = $this->getParameter('kernel.project_dir') . 'src/Data/Json/fruits.json';
        $donneeJson = file_get_contents($cheminJson);
        if($donneeJson === false)
            throw new \Exception("Fichier Json Introuvable");
        $listeFruit = json_decode($donneeJson, true);
        return $listeFruit;
    }

    //Vérifie si l'entrée de l'utilisateur est un fruit ou non
    public function CheckFruit(Request $request) : JsonResponse{
        $userInput = $request->query->get('fruit');
        $listeFruit = $this->getListeFruit();
        $isFruitValid = in_array($userInput, $listeFruit);
        if ($isFruitValid)
            return new JsonResponse(['fruit valide' => true]);
        foreach ($listeFruit as $fruit){
            if(levenshtein(strtolower($userInput), strtolower($fruit)) <= 1)
                return new JsonResponse(['fruit valide' => true]);
        }
        return new JsonResponse(['fruit valide' => false]);
    }
}