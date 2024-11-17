<?php
namespace Backend\Models;

use Exception;
use Firebase\JWT\JWT;
use PDO;
use PDOException;
use Logger\LoggerFactory;
use App\Functions;

//The model for the backend creation stuff. 
class User {

    //The PDO for database retrieval.
    private $pdo;

    //set for fetching to help with defaulting errors when connecting.
    private $connection;

    public function __construct($config, $username = 'root', $password = '') {
        //using the config array file, the dsn connection is created using a build_query helper action. 
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        //the connection is created and set for fetching to help with defaulting errors when connecting. 
        $this->connection = new PDO($dsn, $username,$password ,[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $this->pdo = new PDO($dsn, $username, $password);
    }

    //Creates the user model for the JWT's for searching!
    public function generateJWT($username, $password, $role) {
        $issuedAt = time();
        $expiration = $issuedAt + 3600;
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expiration,
            'username' => $username,
            'password' => $password,
            'role' => $role
        ];

        //Creates and returns the resulting JWT!
        return JWT::encode($payload, 'My-secret-key-is-very-special-and-very-safe', 'HS256');
    }

    //Checks if the username and password are valid before the JWT is created. This is for security sake.
    public function authenticate($username, $password) {
        $logger = LoggerFactory::getInstance()->getLogger();
        
        //Set up  error validation. 
        $errors = [];

        $validateName = Functions\validateUsername($username);
        if ($validateName !== "valid") {
            $errors['username'] = $validateName;
            $logger->warning('The inputted username wasn\'t valid.');
        }

        $validatePassword = Functions\validatePassword($password);
        if($validatePassword !== "valid") {
            $errors['password'] = $validatePassword;
            $logger->warning('The inputted password wasn\'t valid.');
        }

        return $errors;
    }

    //A function that finds a user. 
    public function findUser($username) {
        $logger = LoggerFactory::getInstance()->getLogger();

        try {
            //find username to test if there is a match.
            $stmt = $this->pdo->prepare('select * from accounts where username = :username');
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result) {
                $logger->info('A name was found in the find user function.');
                $JWT = $this->generateJWT($result['username'], $result['password'], $result['role']);
                $_SESSION['LOGIN'] = $JWT;
                return True;

            } else {
                $logger->info('A name wasn\'t found in the find user function.');
                return false;
            }

        } catch(PDOException $e) {
            $logger->error('PDO_ERROR When trying to find user in the database: ' . $e);
            return false; 
            
        } catch(Exception $e) {
            $logger->error('Error found when trying to find a user in the database: ' . $e);
            return false; 
        }
    }

    //adds a user to the database.
    public function addUser($username, $password) {
        try {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare('INSERT INTO accounts(username, password) VALUES(:username, :password)');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam('password', $password);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}