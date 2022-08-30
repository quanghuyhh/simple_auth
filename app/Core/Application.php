<?php

namespace App\Core;

use App\Core\Services\DatabaseServiceProvider;
use App\Core\Services\RouterServiceProvider;
use App\Core\Services\ViewServiceProvider;
use Jenssegers\Blade\Blade;

class Application
{
    /**
     * The base path of the application installation.
     *
     * @var string
     */
    public static $basePath;

    public static $dbConnect = null;

    /**
     * @var Blade $viewFactory
     */
    public static $viewFactory;

    /**
     * The Router instance.
     */
    public static $router;

    public function __construct($basePath = null)
    {
        static::$basePath = $basePath;
        $this->bootstrapSession();

        $this->registerConnections();
        $this->registerViews();
        $this->bootstrapRouter();
    }

    public function registerConnections()
    {
        static::$dbConnect = new DatabaseServiceProvider(
            env('DB_HOST'),
            env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
        );
    }

    /**
     * Bootstrap the router instance.
     *
     * @return void
     */
    public function bootstrapRouter()
    {
        static::$router = new RouterServiceProvider();
        static::$router->boot();
    }

    public function registerViews()
    {
        $viewService = new ViewServiceProvider();
        $viewService->boot();
        static::$viewFactory = $viewService->getViewFactory();
    }

    public function bootstrapSession()
    {
        if (!session_start()) {
            throw new \RuntimeException('Failed to start the session.');
        }
    }
}