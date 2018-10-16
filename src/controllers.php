<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Controllers\HomeController;
use App\Controllers\RegistrationController;

//Request::setTrustedProxies(array('127.0.0.1'));
$app['home.controller'] = function() use ($app) {
    return new HomeController($app);
};

$app['registration.controller'] = function() use ($app) {
    return new RegistrationController($app);
};

$app->get('/', "home.controller:index")->bind('homepage');
$app->get('/registration', "registration.controller:index")->bind('registration');

/*$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage');*/


$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    
    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
