<?php

namespace App\Service;

use App\Controller\Discogs;
use Discogs\ClientFactory;
use App\FruitController;

class ApiConnection {

    public $client = null;

    public function __construct(){
        if ($this->client == null ){
            //ThrottleSubscriber pour eviter des erreurs ou d'etre banni
            $handler = \GuzzleHttp\HandlerStack::create();
            $throttle = new Discogs\Subscriber\ThrottleSubscriber();
            $handler->push(\GuzzleHttp\Middleware::retry($throttle->decider(), $throttle->delay()));

            $access_token = getenv("TOKEN_DISCOGS");
            $this->client = ClientFactory::factory([
                'handler'=>$handler,
                'headers' => [
                    'User-Agent' => getenv("USER_AGENT"),
                    'Authorization' => "Discogs token={$access_token}",
                ]
            ]);
        }
    }

    public function discogsSearch(string $text) {
        $response=$this->client->search([
            'q' => $text
        ]);
        return $response;
        /* // Loop through results
        foreach ($response['results'] as $result) {
            var_dump($result['title']);
        }*/
    }

    private function getArtistsNameAsArray($artists) {
        $arr = array();
        foreach ($artists as $art){
            array_push($arr, $art['name']);
        }
        return $arr;
    }
    private function getTracksAsArray($tracklist) {
        $tracksTitles = array();
        foreach ($tracklist as $t){
            array_push($tracksTitles, $t['title']);
        }
        return $tracksTitles;
    }

    public function discogsSearchFruit(string $fruit) {
        $response=$this->discogsSearch($fruit);
        $retour = array();
        $x = 0;
        foreach ($response['results'] as $result) {
            if ($x >= 50){break;}
            $x++;
            array_push($retour, array(
                "nom"=>$result['title'],
                "coverImage"=> $result['images'][0]['uri'],
                "artiste"=> $this->getArtistsNameAsArray($result['artiste']),
                "styles"=> $result['styles'],
                "genres"=> $result['genres'],
                "sortie"=> $result['year'],
                "label"=> $result['labels'][0]['name'],
                "tracklist"=> $this->getTracksAsArray($result['tracklist']),
            ));
        }
        return $retour;

        return  ;
        /*sous la forme

            'fruit' => [
                ["nom" => "Album1", 'coverImage' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTs3VJ2joGlWpIE-UGCx_EXyiHG4ZltY-55Lk9ZjRq6zg&s', 'artiste' => ['Artist 1'], 'styles' => ['Pop', 'Rock'], "genres": ["Electronic", "Pop"], 'sortie' => '2021', 'label' => 'Label 1', 'tracklist'=> ["titre1", "titre2"]],
                [...],
            ]
        */
    }

    public function getAllFruitsAlbums(){
        $retour = array();
        foreach (getListFruit()['fruits'] as $fruit){
            array_push($retour, $fruit->$this->discogsSearchFruit($fruit));
        }
        return $retour;
    }
}






