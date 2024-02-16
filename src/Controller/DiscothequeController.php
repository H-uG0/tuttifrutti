<?php

namespace App\Controller;

class DiscothequeController
{
    public function triParFruit(&$array){
        usort($array, function($a, $b){
            //return strcmp($a->)
        });
    }
}