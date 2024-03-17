<?php

namespace Nuazsa\MailSender\Services;

class Router
{
    private static array $routes = [];

    public static function add(string $method, string  $path, string  $controller, string  $function, array $middlewares = []): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middlewares' => $middlewares
        ];
    }

    public static function get(string  $path, string  $controller, string  $function, array $middlewares = []): void
    {
        self::add('GET', $path, $controller, $function, $middlewares);
    }

    public static function post(string  $path, string  $controller, string  $function, array $middlewares = []): void
    {
        self::add('POST', $path, $controller, $function, $middlewares);
    }

    public static function run(): void
    {
        $path = '/';

        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {

            $pattern = "#^" . $route["path"] . "$#";

            if (preg_match($pattern, $path, $variable) && $route['method'] == $method) {

                foreach ($route['middlewares'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                $controller = new $route['controller'];
                $function = $route['function'];

                array_shift($variable);
                call_user_func_array([$controller, $function], $variable);

                return;
            }
        }

        http_response_code(404);
        View::render('components/header');
        echo "Controller not found";
    }
}