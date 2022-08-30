<?php

namespace App\Core\Services;

use Bramus\Router\Router;

class RouterServiceProvider
{
    public static Router $router;

    public function __construct()
    {
        static::$router = new Router();
    }

    public function boot()
    {
        $this->createRouter();
        $this->run();
    }

    public function createRouter()
    {
        $router = new Router();
        require_once base_path('routes/web.php');
        static::$router = $router;
    }

    public function run()
    {
        static::$router->run();
    }
}