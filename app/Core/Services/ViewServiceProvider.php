<?php

namespace App\Core\Services;

use Jenssegers\Blade\Blade;

class ViewServiceProvider
{
    public static Blade $viewFactory;

    public function boot()
    {
        static::$viewFactory = static::$viewFactory ?? $this->createViewFactory();
    }

    public function createViewFactory(): Blade
    {
        return new Blade('resources/views', 'storage/cache');
    }

    public function getViewFactory(): Blade
    {
        return static::$viewFactory;
    }
}