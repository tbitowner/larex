<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/* @var $app \Silex\Application */

$routes = $app['controllers_factory'];

$routes->get('/', '\BaseController::showWelcome')
    ->bind('index');

$routes->get('/users', '\UserController::indexController')
    ->bind('users');

$app->mount('/', $routes);