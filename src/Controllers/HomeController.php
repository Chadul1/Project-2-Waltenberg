<?php 

namespace App\Controllers;

use Logger\LoggerFactory;


//The controller that represents the homepage.
class HomeController {
    
    //The homepage index. 
    function index($request, $response, $args) {
        //require home view.
        require_once __DIR__ . '/../Views/HomeView.php';
        
        //Logger actions
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has arrived to the home page.');

        return $response;
    }
}

