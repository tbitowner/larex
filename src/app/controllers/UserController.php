<?php

use PHPassLib\Hash\BCrypt;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Cookie;



class UserController 
{

    public function indexController(Application $app, Request $request) 
    {

        return $app['twig']->render('index.twig', [
            'users' => User::all()
        ]);    
    }

    public function logoutController(Application $app, Request $request) 
    {
  
    }
}
