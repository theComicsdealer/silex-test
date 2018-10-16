<?php

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Entity\SavedSession;
use App\Models\Repository\SavedSessionRepository;

class RegistrationController
{
    private $app;
    private $request;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->request = $app['request_stack']->getCurrentRequest();
    }

    public function index(){
        $identifier = $this->request->query->get('identifier');

        if($identifier){
            $savedSession = $this->loadSavedSession($identifier);
            return $this->app['twig']->render('registration.html.twig', array('session' => array())); //$savedSession->getData()
        }
        else{
            return $this->app['twig']->render('registration.html.twig', array());
        }
    }

    public function loadSavedSession($identifier){
        $savedSession = $this->app['doctrine']->getRepository(SavedSession::class)->findOneBy(array('identifier' => $identifier));
        return $savedSession;
    }
    
}