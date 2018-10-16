<?php

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function index(){
        setcookie('identifier', 'toto', time() + (86400 * 30), '/');
        $identifier = $_COOKIE['identifier'];
        
        if($identifier){
            return $this->app['twig']->render('index.html.twig', array('visited' => true, 'identifier' => $identifier));
        }
        else{
            return $app->redirect('/registration');
        }
    }
    
}