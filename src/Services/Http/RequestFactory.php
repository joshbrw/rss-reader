<?php

namespace Joshbrw\RSS\Services\Http;

use Joshbrw\RSS\Routing\Request;

final class RequestFactory
{
    public static function fromCurrentRequest(): Request
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $postData = $_POST ?? [];
        $queryString = $_GET ?? [];

        return new Request(
          $uri,
          $method,
          $postData,
          $queryString
        );
    }
}
