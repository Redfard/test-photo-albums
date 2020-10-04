<?php

namespace App;

class Router
{
    public function init(array $routes): void
    {
        $uri = $this->getURI();
        
        $controller = explode('@', $routes[$uri]);
        $class      = 'App\Controllers\\' . $controller[0];
        $method     = $controller[1];

        (new $class)->$method();
    }

    public function getURI(): string
    {
        if (! empty($_SERVER['REQUEST_URI'])) {
            return trim(
                explode('?', $_SERVER['REQUEST_URI'], 2)[0],
                '/'
            );
        }
    }

}