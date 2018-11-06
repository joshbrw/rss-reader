<?php

namespace Joshbrw\RSS\Routing;

class Router
{
    /**
     * @var Route[]
     */
    private $routes = [];

    public function registerRoute(Route $route): Router
    {
        $this->routes[] = $route;

        return $this;
    }

    /**
     * @return Route[]
     */
    public function all(): array
    {
        return $this->routes;
    }
}
