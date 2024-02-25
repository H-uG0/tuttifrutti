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
        $cheminJson = '../src/Data/Json/fruits.json';
        $donneeJson = file_get_contents($cheminJson);
        if($donneeJson === false)
            throw new \Exception("Fichier Json Introuvable");
        return json_decode($donneeJson, true);
    }

    public function normaliseNomFruit(string $fruit) : string{
        $accents = ['é', 'è', 'ê', 'à', 'ù'];
        $sansAccents = ['e', 'e', 'e', 'a', 'u'];
        return str_replace($accents, $sansAccents, strtolower($fruit));
    }

    //Vérifie si l'entrée de l'utilisateur est un fruit ou non
    public function CheckFruit(Request $request) : bool{
        $userInput = $request->query->get('fruit');
        $listeFruit = $this->getListeFruit();
        $isFruitValid = in_array($userInput, $listeFruit);

        if ($isFruitValid)
            return true;

        foreach ($listeFruit as $fruit)
            if(levenshtein($this->normaliseNomFruit($userInput), $this->normaliseNomFruit($fruit)) <= 1)
                return true;

        return false;
    }
}