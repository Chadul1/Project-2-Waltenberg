<?php 

namespace App\Controllers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PDOException;
use Logger\LoggerFactory; 
use Backend\Models\User;
use App\Functions;

///The class for the login controller.
class LoginController {
    
    //The initial login page.
    function index($request, $response, $args) {
        require("../src/Views/Login.php");
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has gone to the login page.');

        return $response;
    }

    //Stores and enables the user to play the game.
    function store($request, $response, $args) {
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has submitted the login form.');

        //require view 
        require('../src/Views/Login.php');

        //Require database config.
        $config = require_once '../src/config.php';

        //Set up error validation. 
        $errors = [];

        //Grabs the contents of the post elements and sanitizes them.
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        //try to see if the information already exists in the database.
        try {
            //Set up config and add needed data elements (Username/password)
            $userService = new User($config['database']);
            $logger->info('The database was contacted to search for username');
            $user = $userService->findUser($username);
        }
        catch (PDOException $e) {
            $logger->error('There was an error connecting to the database.');
            $errors = [
                'username' => 'There was an error connecting to the database'
            ];
            $_SESSION['errors'] = $errors;
            echo '<meta http-equiv="refresh" content="0;url=../public/login" method="POST">';
            return $response;
        }

        //If the user isn't found, the error is thrown.
        if ($user === false) {
            $errors = [
                'username'=> 'No matching account found with that username',
            ];
            $logger->warning('No username was found.');
            $_SESSION['errors'] = $errors;
            echo '<meta http-equiv="refresh" content="0;url=../public/login" method="POST">';
            return $response;

        } else {
            //Finds and returns the LOGIN JWT;
            if(isset($_SESSION['LOGIN'])) {
                $user = $_SESSION['LOGIN'];
                $user = JWT::decode($user, new Key('your-secret-key', 'HS256'));

                //Verifies the password against the hash. If it works, it works and the user is logged in.
                if (password_verify($password, $user->password)) {
                    functions\login( $user->role);
                    $logger->info('The password was valid and the user was logged in.');
                    echo '<meta http-equiv="refresh" content="0;url=../public/" method="POST">';
                    return $response;

                } else {
                    //if the password isn't verified, than an error is thrown and displayed to the user.
                    $errors = [ 
                        'password'=> 'Incorrect password!',
                    ];
                    $logger->info('The inputted password was invalid.');
                    $_SESSION['errors'] = $errors;
                    echo '<meta http-equiv="refresh" content="0;url=../public/login" method="POST">';
                    return $response;
                }
            } else {
                return $response;
            }
        }
    }

    //Logs out of the session and destroys it. 
    function destroy($request, $response, $args) {
        //logs out the user, destroys the session and cookie attached to it.
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has logged out.');
        //session destroyed.
        Functions\logout();
        //logger action
        $logger->info('The session was reset.');
        //redirects the user.
        echo '<meta http-equiv="refresh" content="0;url=../public">';
        return $response;
    }
}