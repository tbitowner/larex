<?php
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();

$app['debug'] = true;

$config = require __DIR__.'/config.php';

foreach($config as $k=>$v) {
    $app[$k] = $v;
}

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\RoutingServiceProvider());

$app->register(new Silex\Provider\SwiftmailerServiceProvider(), array(
    'swiftmailer.options' => $config['swiftmailer.options']
));

if(isset($app['app.email_to'])){
    $app['mailer']->registerPlugin(new \YourAppName\Swift\Plugins\InterceptPlugin($app['app.email_to']));
}

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__.'/../app/views',
    'twig.options' => ['strict_variables' => false]
]);

$app['twig'] = ($app->extend('twig', function($twig, $app) {
    
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use($app) {
        // implement whatever logic you need to determine the asset path

        return sprintf($app['app.static_root_web'], ltrim($asset, '/'));
    }));

    $twig->addFunction(new \Twig_SimpleFunction('bootstrap', function ($asset) use($app) {
        // implement whatever logic you need to determine the asset path
      
        return sprintf($app['app.static_root_web_bootstrap'], ltrim($asset, '/'));
    }));

    $twig->addFunction(new \Twig_SimpleFunction('grayscale', function ($asset) use($app) {
        // implement whatever logic you need to determine the asset path
   
        return sprintf($app['app.static_root_web_grayscale'], ltrim($asset, '/'));
    }));

    return $twig;
}));

require $app["app.migration"];

require __DIR__.'/database.php';

require __DIR__.'/middleware.php';

require __DIR__.'/routes.php';

$app->error(function (\Exception $e, $code) use ($app) {
    if($app['debug']) {
        return;
    }

    switch ($code) {
        case 404:
            $app['monolog']->warn($e);
            return "404";
            //return $app['twig']->render('pages/404.html.twig');
            break;
        default:
            $app['monolog']->err($e);
            return "Error";
            //return $app['twig']->render('pages/page_error.html.twig');

    }

});

return $app;