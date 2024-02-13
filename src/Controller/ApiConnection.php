<?php

namespace App\Controller;

use Discogs\ClientFactory;
use Discogs\DiscogsClient;

class ApiConnection {

    public var $client = null;

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
// Loop through results
        foreach ($response['results'] as $result) {
            var_dump($result['title']);
        }
    }
}






