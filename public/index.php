<?php 

namespace App;

//Additional Files are required and the composer autoLoader is loaded. 
require("../logger/logger.php");
require("../vendor/autoload.php");
//Grabs a general use case function class.
require_once '../src/functions.php';
require("../src/Middleware/Middleware.php");

//Usings are called.
use function Logger\initializeLogger;
use Logger\LoggerFactory;
use Slim\Factory\AppFactory;


///The App is created.
$app = AppFactory::create();
session_start();
require_once('../src/routes.php');

///Sets up the logger.
initializeLogger('text');
$logger = LoggerFactory::getInstance()->getLogger();

//The app is ran.
$app->run();

