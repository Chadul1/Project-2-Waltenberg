<?php

namespace App\Controllers;

use App\Functions;
use PDOException;
use Logger\LoggerFactory; 
use Backend\Models\User;

///The controller that routes the registering the user.
class RegisterController {
    
    ///The Index for the registration page.
    public function index($request, $response, $args) {
        //require the view.
        require('../src/Views/RegisterView.php');

        //logger actions.
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has gone to the Register page');

        return $response;
    }

    ///Adds a User.
    public function AddUser($request, $response, $args) {
        //Adds the logger for logging.
        $logger = LoggerFactory::getInstance()->getLogger();
        $logger->info('The user has submitted their account registration.');

        //Requires view and the database config.
        require('../src/Views/RegisterView.php');
        $config = require_once '../src/config.php';

        //grab the content of the POST and sanitizes them.
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        //Using the user model, the username and password are authenticated. 
        $userService = New User($config['database']);
        $errors = $userService->authenticate($username, $password);

        //If there are errors, the user is redirected and the errors are shown.
        if (! empty($errors)) {
            $_SESSION['errors'] = $errors;
            $logger->error('The inputted form wasn\'t valid.');
            echo '<meta http-equiv="refresh" content="0; url=../public/register" method="POST">'; 
            return $response;
        }

        //try to see if the information already exists in the database.
        try {
            //Set up config and add needed data elements (Username)
            $result = $userService->findUser($username);
        }
        catch (PDOException $e) {
            //redirects with database error.
            $errors = [
                'username' => 'There was an error connecting to the database'
            ];
            $_SESSION['errors'] = $errors;
            //logger actions.
            $logger->error('There was an error connecting to the database.');
            //redirect
            echo '<meta http-equiv="refresh" content="0;url=../public/register" method="POST">';
            return $response;
        }

        //Checks to see if the username already exists.
        if ($result === true) {
            //if the account is found, it redirects and displays user error. 
            $errors['username'] = "Account already exists with that username, please choose another.";
            $_SESSION['errors'] = $errors;
            //logger actions.
            $logger->warning('The account name already existed.');
            //redirect.
            echo '<meta http-equiv="refresh" content="0; url=../public/register" method="POST">';
            return $response;
        } else {
            try {
                //User the user model to set up the database
                $userService = new User($config['database']);
                $userService->addUser($username, $password);

                $logger->info('The account was added.');
            
                Functions\login('user');
            
                echo '<meta http-equiv="refresh" content="0;url=../public">';
            } catch (PDOException $e) {
                //redirects with database error.
                $errors = [
                    'username' => 'There was an error connecting to the database'
                ];
                $_SESSION['errors'] = $errors;
                //logger actions.
                $logger->error('There was an error connecting to the database.');
                //redirect
                echo '<meta http-equiv="refresh" content="0;url=../public/register" method="POST">';
                return $response;;
            }
        }
        //returns the response from the call.
        return $response;
    }
}