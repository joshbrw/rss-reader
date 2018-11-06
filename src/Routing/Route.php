<?php

namespace Joshbrw\RSS\Routing;

class Route
{

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $controller;

    public function __construct(string $uri, string $method = 'GET', string $controller)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }
}
