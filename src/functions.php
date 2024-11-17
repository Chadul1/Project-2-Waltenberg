<?php

namespace App\Functions;

//A function that logs in the user and uses their username. 
function login($user)
{
    //regenerates the session ID.
    session_regenerate_id(true);
    
    //Sets the user role for middleware management and display.
    $_SESSION['user_roles'] = $user;
    
}

//A function that logs out the user from the session.
function logout() {
    //voids the current session data and destroys the session along with the cookie. 
    $_SESSION = [];
    session_destroy();
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}


//Validates the username.
function validateUsername($username) {
    // Check the length (between 3 and 20 characters)
    if (strlen($username) < 3 || strlen($username) > 20) {
        return "Username must be between 3 and 20 characters long.";
    }

    // Check for allowed characters (alphanumeric, underscores, and dots)
    if (!preg_match('/^[a-zA-Z0-9._]+$/', $username)) {
        return "Username can only contain letters, numbers, underscores, and dots.";
    }

    // Ensure it doesn't start or end with an underscore or dot
    if (preg_match('/^[_\.]|[_\.]$/', $username)) {
        return "Username cannot start or end with an underscore or dot.";
    }

    // Ensure there are no consecutive dots or underscores
    if (preg_match('/[_.]{2,}/', $username)) {
        return "Username cannot have consecutive dots or underscores.";
    }

    return "valid";  // Valid username
}

//Checks for valid password.
function validatePassword($password) {

    // Check the length (at least 8 characters)
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    // Check for at least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must contain at least one uppercase letter.";
    }

    // Check for at least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        return "Password must contain at least one lowercase letter.";
    }

    // Check for at least one number
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one number.";
    }

    // Check for at least one special character
    if (!preg_match('/[\W_]/', $password)) {
        return "Password must contain at least one special character.";
    }
    
    return "valid";  // Valid password
}