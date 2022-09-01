<?php

/** @var \Bramus\Router\Router $router */
use App\Helpers\Auth;
$router->get('/', function () {
    echo view('demo')->render();
});

$router->mount('/api', function () use ($router) {
    $router->mount('/auth', function () use ($router) {
        $router->post('/login', '\App\Http\Controllers\AuthController@processSignIn');
        $router->post('/register', '\App\Http\Controllers\AuthController@processSignup');
    });

    $needAuthMiddlewares = [
        '/' => 'GET',
        '/profile' => 'GET|POST',
        '/logout' => 'POST',
    ];
    foreach ($needAuthMiddlewares as $path => $methods) {
        $router->before($methods, $path, fn() => Auth::needAuth(Auth::check()));
    }
    $router->get('/profile', '\App\Http\Controllers\HomeController@profile');
    $router->post('/profile', '\App\Http\Controllers\HomeController@updateProfile');
    $router->post('/logout', '\App\Http\Controllers\AuthController@signOut');
});



