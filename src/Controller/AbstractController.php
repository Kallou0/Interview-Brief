<?php

namespace App\Controller;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_Extensions_Extension_Text;

abstract class AbstractController
{
    protected function render(string $template, array $context = []) {
        // Specify our Twig templates location
        $loader = new Twig_Loader_Filesystem(ROOT_PATH . '/templates');

        // Instantiate our Twig
        $twig = new Twig_Environment($loader);
        $twig->addExtension(new Twig_Extensions_Extension_Text()); //we want to use truncate in our templates
        echo $twig->render($template, $context);
    }

    protected function model($modelName,$data=[]) {
        $path = "src/Model/".$modelName.".php";
        if(file_exists($path)){
            require_once "src/Model/".$modelName.".php";
            return new $modelName;
        } 
        else{
            echo "model ".$modelName." not found";
        }
    }

}