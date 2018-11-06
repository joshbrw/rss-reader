<?php

namespace Joshbrw\RSS\Exceptions\Routing;

use Exception;
use Joshbrw\RSS\Routing\Request;

class RouteNotFoundException extends Exception
{
    public static function fromRequest(Request $request): self
    {
        return new self("Route not found for {$request->getMethod()} {$request->getUri()}");
    }
}
