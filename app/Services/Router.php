<?php

namespace Nuazsa\MailSender\Services;

class Router
{
    private static array $routes = [];
    private static array $prefixes = [];
    
    private static function getPath(string $path): string
    {
        $prefix = implode('', self::$prefixes);
        return $prefix . $path;
    }
    
    public static function add(string $method, string $path, string $controller, string $function, array $middlewares = []): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => self::getPath($path),
            'controller' => $controller,
            'function' => $function,
            'middlewares' => $middlewares
        ];
    }

    public static function get(string $path, string $controller, string $function, array $middlewares = []): void
    {
        self::add('GET', $path, $controller, $function, $middlewares);
    }

    public static function post(string $path, string $controller, string $function, array $middlewares = []): void
    {
        self::add('POST', $path, $controller, $function, $middlewares);
    }

    public static function prefix(string $prefix, callable $callback): void
    {
        self::$prefixes[] = $prefix;
        $callback();
        array_pop(self::$prefixes);
    }

    public static function run(): void
    {
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $pattern = "#^" . $route["path"] . "$#";

            if (preg_match($pattern, $path, $matches) && $route['method'] === $method) {
                foreach ($route['middlewares'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                $controller = new $route['controller'];
                $function = $route['function'];

                array_shift($matches); // Remove the full match
                call_user_func_array([$controller, $function], $matches);
                return;
            }
        }

        http_response_code(404);
        echo "Controller not found";
    }
}