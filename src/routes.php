<?php 

use App\Controllers;
use Slim\Exception\HttpNotFoundException;
use Slim\Psr7\Response;
use function App\Middleware\roleMiddleware;

//Creates the routes for the website.  
$app->get('/Project-2-Waltenberg/public/', Controllers\HomeController::class . ':index');
//Routes for registering a new user. 
$app->get('/Project-2-Waltenberg/public/register', Controllers\RegisterController::class . ':index');
$app->post('/Project-2-Waltenberg/public/register', Controllers\RegisterController::class . ':addUser');
//Route to the game.
$app->get('/Project-2-Waltenberg/public/game', Controllers\GameController::class . ':index')->add(roleMiddleware(['user', 'admin']));
//route to the settings.
$app->get('/Project-2-Waltenberg/public/settings', Controllers\SettingsController::class . ':index');
//routes for the login and logout functions. 
$app->get('/Project-2-Waltenberg/public/login', Controllers\LoginController::class . ':index');
$app->post('/Project-2-Waltenberg/public/login',  Controllers\LoginController::class . ':store');
$app->post('/Project-2-Waltenberg/public/logout',  Controllers\LoginController::class . ':destroy');


// Set the custom handler for the errors in case of an out of bounds search for graceful 404 handling.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function (
    $request,
    HttpNotFoundException $exception,
    bool $displayErrorDetails
) {
    $response = new Response();
    $response->getBody()->write("<h3>Page not found. Please check the URL.");
    $response->getBody()->write("\n <h1><a href='/Project-2-Waltenberg/public/' style='text-decoration: none'>Return to Home page?");
    return $response->withStatus(404);
});
