<?php

namespace App\Service;

use App\Controller\Discogs;
use Discogs\ClientFactory;
use Discogs\ThrottleSubscriber;
use App\Controller\FruitController;
use Psr\Log\LoggerInterface;

class ApiConnection
{
    private $logger;


    public $client = null;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        if ($this->client == null) {
            //ThrottleSubscriber pour eviter des erreurs ou d'etre banni
            $handler = \GuzzleHttp\HandlerStack::create();
            $throttle = new \Discogs\Subscriber\ThrottleSubscriber();
            $handler->push(\GuzzleHttp\Middleware::retry($throttle->decider(), $throttle->delay()));

            $access_token = getenv("TOKEN_DISCOGS");
            $this->client = ClientFactory::factory([
                'handler' => $handler,
                'headers' => [
                    // 'User-Agent' => getenv("USER_AGENT"),
                    // 'Authorization' => "Discogs token={$access_token}",
                    'User-Agent' => "Tuttifrutti-Gr-AHN/0.0",
                    'Authorization' => "Discogs token=ygynhFbJyUUXaYWiAgSztDQzauWwGMpddIPKkBNZ",
                ]
            ]);
        }
    }

    public function discogsSearch(string $text)
    {
        if ($this->client == null) {
            return "error client is null";
        }
        $response = $this->client->search([
            'q' => $text,
            'type' => 'release'
        ]);
        return $response;
        /* // Loop through results
        foreach ($response['results'] as $result) {
        var_dump($result['title']);
        }*/
    }

    public function discogsSearchFruit(string $fruit) {
        $response = $this->discogsSearch($fruit);
        $this->logger->info('Discogs search response: ' . json_encode($response));
        $retour = array();
        $x = 0;
        foreach ($response['results'] as $result) {
            if ($x >= 10) {
                break;
            }
            $x++;
    
            // Fetch the first image URI if available
            $coverImage = $result['cover_image'] ?? 'default_image_uri_here';
    
            // Concatenate artist(s) names
            $artistNames = array_map(function($artist) {
                return $artist['name'];
            }, $result['artists'] ?? []);
            $artistName = implode(", ", $artistNames) ?: 'Unknown Artist';
    
            // Concatenate label(s) names
            $labelNames = array_map(function($label) {
                return $label['name'];
            }, $result['labels'] ?? []);
            $labelName = implode(", ", $labelNames) ?: 'Unknown Label';
    
            // Concatenate genres
            $genres = implode(", ", $result['genre'] ?? []) ?: 'Unknown Genres';
    
            // Concatenate styles
            $styles = implode(", ", $result['style'] ?? []) ?: 'Unknown Styles';
    
            // Handling the tracklist as string (assuming your getTracksAsArray method does what's expected)
            $tracklist = isset($result['tracklist']) ? implode(", ", $this->getTracksAsArray($result['tracklist'])) : 'No Tracklist';
    
            array_push($retour, array(
                "id" => $result['id'] ?? 'Unknown ID',
                "nom" => $result['title'] ?? 'Unknown Title',
                "coverImage" => $coverImage,
                "artiste" => $artistName,
                "styles" => $styles,
                "genres" => $genres,
                "sortie" => $result['year'] ?? 'Unknown Year',
                "label" => $labelName,
                "tracklist" => $tracklist,
            ));
        }
        return $retour;
    }
    
    

    private function getArtistsNameAsArray($artists)
    {
        $arr = array();
        foreach ($artists as $art) {
            array_push($arr, $art['name']);
        }
        return $arr;
    }

    private function getTracksAsArray($tracklist)
    {
        $tracksTitles = array();
        foreach ($tracklist as $t) {
            array_push($tracksTitles, $t['title']);
        }
        return $tracksTitles;
    }



    public function getAllFruitsAlbums()
    {
        $retour = array();
        $fruitcontroller = new FruitController();
        foreach ($fruitcontroller->getListeFruit()['fruits'] as $fruit) {
            $retour[$fruit] = $this->discogsSearchFruit($fruit);
        }
        return $retour;
    }
}