<?php

use PHPassLib\Hash\BCrypt;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;


class BaseController 
{

    public function showWelcome(Application $app, Request $request) 
    {

        return $app['twig']->render('welcome.twig', [
            'message' => "A Silex and Laravel Website",
        ]);    
    }

}
