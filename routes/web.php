<?php

/** @var \Bramus\Router\Router $router */
use App\Helpers\Auth;

$router->mount('/auth', function () use ($router) {
    $router->before('GET', '/login', fn () => Auth::redirectIf(Auth::check(), '/'));
    $router->get('/login', '\App\Http\Controllers\AuthController@signIn');
    $router->post('/login', '\App\Http\Controllers\AuthController@processSignIn');

    $router->before('GET', '/register', fn () => Auth::redirectIf(Auth::check(), '/'));
    $router->get('/register', '\App\Http\Controllers\AuthController@signUp');
    $router->post('/register', '\App\Http\Controllers\AuthController@processSignup');
});


$router->get('/demo', '\App\Http\Controllers\HomeController@index');

$router->before('GET', '/', fn () => Auth::redirectIf(!Auth::check(), '/auth/login'));
$router->get('/', '\App\Http\Controllers\HomeController@index');

$router->before('GET|POST', '/my-profile', fn () => Auth::redirectIf(!Auth::check(), '/auth/login'));
$router->before('POST', '/logout', fn () => Auth::redirectIf(!Auth::check(), '/auth/login'));

$router->get('/my-profile', '\App\Http\Controllers\HomeController@profile');
$router->post('/my-profile', '\App\Http\Controllers\HomeController@updateProfile');
$router->post('/logout', '\App\Http\Controllers\AuthController@signOut');