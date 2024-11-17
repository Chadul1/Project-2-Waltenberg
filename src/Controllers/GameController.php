<?php

namespace App\Controllers;

use Logger\LoggerFactory;

//the controller that handles Game functions.
class GameController {

    ///The index that starts the game. 
    function index ($request, $response, $args) {
        //require the game view.
        require('../src/Views/GameView.php');

        //Logger actions
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has started the game.');

        return $response;
    }
}