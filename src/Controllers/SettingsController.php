<?php 

namespace App\Controllers;
use Logger\LoggerFactory;

///The controller for the settings endpoint.
class SettingsController {

    //The Settings Index that requires the settings page. 
    function index($request, $response, $args) {
        //requires the user view.
        require("../src/Views/Settings.php");
        //logger actions.
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has gone to the Settings.');

        return $response;
    }    
}

