<?php

$APP_ROOT = __DIR__;

$migration = __DIR__.'/migration.php';

return [
    'app.app_root' => $APP_ROOT,
    'app.migration' => $migration,

    'app.static_root_web' => $_SERVER['HTTP_HOST'] . '/../assets/%s',
    'app.static_root_web_bootstrap' => $_SERVER['HTTP_HOST'] . '/../assets/lib/bootstrap-3.1.1-dist/%s',
    'app.static_root_web_grayscale' => $_SERVER['HTTP_HOST'] . '/../assets/lib/grayscale/%s',

    'app.secret_key' => md5('YOUR APP NAME'),

    'swiftmailer.options' => array(
        'host' => 'localhost',
        'port' => '25',
        'username' => '',
        'password' => '',
        'encryption' => '',
        'auth_model' => ''
    ),

 

    'app.email_from' => 'youremail@gmail.com',
    'app.email_from_name' => 'PHP DEV' 

];

if(file_exists(__DIR__.'/config.local.php')) 
{
    require __DIR__.'/config.local.php';
}