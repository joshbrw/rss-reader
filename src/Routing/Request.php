<?php

namespace Joshbrw\RSS\Routing;

class Request
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
     * @var array
     */
    private $postData;

    /**
     * @var array
     */
    private $queryString;

    public function __construct(
      string $uri,
      string $method = 'GET',
      array $postData = [],
      array $queryString = []
    ) {
        $this->uri = $uri;
        $this->method = $method;
        $this->postData = $postData;
        $this->queryString = $queryString;
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
     * @return array
     */
    public function getPostData(): array
    {
        return $this->postData;
    }

    /**
     * @return array
     */
    public function getQueryString(): array
    {
        return $this->queryString;
    }

    public function input(string $key, $default = null)
    {
        return $this->postData[$key] ?? $this->queryString[$key] ?? $default;
    }
}
