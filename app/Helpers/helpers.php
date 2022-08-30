<?php

use App\Core\Env;
use App\Helpers\Arr;
use App\Core\Application;
use App\Helpers\FlashMessage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value(mixed $value, ...$args): mixed
    {
        return $value instanceof Closure ? $value(...$args) : $value;
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        return Env::get($key, $default);
    }
}

if (! function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     *
     * @param  string|object  $class
     * @return string
     */
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (! function_exists('data_get')) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param  mixed  $target
     * @param  string|array|int|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function data_get($target, $key, $default = null)
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode('.', $key);

        foreach ($key as $i => $segment) {
            unset($key[$i]);

            if (is_null($segment)) {
                return $target;
            }

            if ($segment === '*') {
                if (! is_iterable($target)) {
                    return value($default);
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (! function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param string $path
     * @return string
     */
    function base_path(string $path = ''): string
    {
        return \App\Core\Application::$basePath .($path ? '/'.$path : $path);
    }
}

if (! function_exists('view')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string|null $view
     * @param array $data
     * @param array $mergeData
     */
    function view(string $view = null, array $data = [], array $mergeData = [])
    {
        $factory = Application::$viewFactory;

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($view, $data, $mergeData);
    }
}

if (! function_exists('encrypt')) {
    /**
     * @param string|null $input
     * @return false|string
     */
    function encrypt(string $input = null): bool|string
    {
        return hash('sha256', $input);
    }
}

if (! function_exists('session')) {
    /**
     * Get / set the specified session value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param  array|string|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function session(array|string $key = null, array|string $default = null): mixed
    {
        if (is_null($key)) {
            return $_SESSION;
        }

        if (is_array($key)) {
            return $_SESSION = array_merge($_SESSION, $key);
        }

        return $_SESSION[$key] ?? $default;
    }
}

if (! function_exists('redirect')) {
    function redirect(string $path, int $statusCode = 301): void
    {
        header("Location: {$path}");
        exit();
    }
}

if (! function_exists('auth')) {
    /**
     * Get the available auth instance.
     */
    function auth()
    {
        return session('user');
    }
}

if (! function_exists('flash')) {

    /**
     * Arrange for a flash message.
     *
     * @param string|null $message
     * @param string $level
     * @return FlashMessage
     */
    function flash(string $message = null, string $level = 'info'): FlashMessage
    {
        $notifier = new FlashMessage();

        if (! is_null($message)) {
            return $notifier->message($message, $level);
        }

        return $notifier;
    }

}

if (! function_exists('back')) {

    /**
     * Redirect back.
     *
     * @return void
     */
    function back()
    {
        $referrer = $_SERVER['HTTP_REFERER'];

        redirect($referrer ?? '/');
    }

}

if (! function_exists('session_forget')) {

    /**
     * Redirect back.
     *
     * @return void
     */
    function session_forget(string $key = null)
    {
        if (empty($key) || !isset($_SESSION[$key])) {
            return;
        }

        unset($_SESSION[$key]);
    }
}

if (! function_exists('upload_image')) {

    /**
     * @param UploadedFile $file
     * @return string|null
     */
    function upload_image(UploadedFile $file): ?string
    {
        $fileName = $file->getClientOriginalName();
        $path = "assets/upload";
        $file->move(base_path($path), $fileName);
        return "/{$path}/{$fileName}";
    }
}


