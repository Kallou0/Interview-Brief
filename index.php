<?php

use App\Controller\HomeController;
use App\Controller\MovieController;
use App\Controller\AuthenticationController;

require __DIR__ . '/vendor/autoload.php';

const ROOT_PATH = __DIR__;
$base_name = basename(__DIR__);

// Routing
$HomeController = new HomeController();
$MovieController = new MovieController();
$AuthenticationController = new AuthenticationController();

$router = new AltoRouter();
$router->setBasePath('/'.$base_name);
$router->map('GET','/', [$MovieController, "index"]);
$router->map('GET','/home', [$MovieController, "index"]);
$router->map('GET','/login', [$AuthenticationController, "login"]);
$router->map('GET','/logout', [$AuthenticationController, "logout"]);
$router->map('GET','/favourites', [$MovieController, "getFavourites"]);
$router->map('GET','/contact', [$HomeController, "contact"]);
$router->map('POST','/authenticate', [$AuthenticationController, "authenticate"]);
$router->map('POST','/add-favourite', [$MovieController, "addToFavourites"]);
$router->map('POST','/search-movie', [$MovieController, "index"]);
//$router->map('GET','/add-favourite/[obj:movie]', [$MovieController, "addToFavourites"]);

$match = $router->match();

if($match && is_callable($match['target'])) {
    if(!empty($match['params'])){
        call_user_func($match['target'], $match['params']);
    }else{
        call_user_func($match['target']);
    }
} else {
    $HomeController->execute404();
}