<?php

namespace App\Controller;
use App\Controller\MovieController;

class AuthenticationController extends AbstractController {

    private $movieController;

    public function __construct() {}
    
    public function login() {
        $this->render('authentication/login.html.twig');
    }

    public function authenticate() {
        session_start();
        $db_model = $this->model("DatabaseMovieModel");
        $con = $db_model->start_connection();
        
        // Now we check if the data from the login form was submitted, isset() will check if the data exists.
        if ( !isset($_POST['username'], $_POST['password']) ) {
            // Could not get the data that should have been sent.
            exit('Please fill both the username and password fields!');
        }

        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
        if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('s', $_POST['username']);
            $stmt->execute();
            // Store the result so we can check if the account exists in the database.
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                // Account exists, now we verify the password.
                // Note: remember to use password_hash in your registration file to store the hashed passwords.
                if (password_verify($_POST['password'], $password)) {
                    // Verification success! User has logged-in!
                    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    $this->authenticated();
                } else {
                    // Incorrect password
                    echo 'Incorrect username and/or password!';
                }
            } else {
                // Incorrect username
                echo 'Incorrect username and/or password!';
            }


            $stmt->close();
        }

    }
    public function authenticated() {
        // If the user is not logged in redirect to the login page...
        if (!isset($_SESSION['loggedin'])) {
            $this->render('authentication/login.html.twig');
        }
        //$this->render('movies/favourites.html.twig');
        $movieController = new MovieController();
        $movieController->getFavourites();
    }
    public function logout() {
        session_start();
        session_destroy();
        // Redirect to the login page:
        $this->render('authentication/login.html.twig');
    }

}

?>