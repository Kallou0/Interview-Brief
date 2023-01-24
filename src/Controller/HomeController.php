<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    public function __construct(){}

    public function contact() {
        $this->render('info/contact.html.twig'); 
    }

    //404 page 
    public function execute404() {
        $this->render('errors/404.html.twig');
    }
}