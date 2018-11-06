<?php

namespace Joshbrw\RSS\Services\Routing;

use Joshbrw\RSS\Exceptions\Routing\RouteNotFoundException;
use Joshbrw\RSS\Routing\Request;
use Joshbrw\RSS\Routing\Route;

class RouteMatcher
{
    /** @throws RouteNotFoundException */
    public static function match(Request $request, array $routes)
    {
        foreach ($routes as $route) {
            if (static::matches($request, $route)) {
                return $route;
            }
        }

        throw RouteNotFoundException::fromRequest($request);
    }

    private static function matches(Request $request, Route $route): bool
    {
        if ($request->getMethod() !== $route->getMethod()) {
            return false;
        }

        return static::matchesPath($request->getUri(), $route->getUri());
    }

    private static function matchesPath(string $requestUri, string $routeUri): bool
    {
        // Normalise the Route and Request URI
        $routeUri = rtrim($routeUri, '/');
        $requestUri = rtrim($requestUri, '/');

        // If the request URI and the route URI are the same - this is the route we're looking for.
        if ($requestUri === $routeUri) {
            return true;
        }

        // Make sure the URI contains {placeholders}
        if (preg_match('#\{([\w_]+)\}#', $routeUri, $matches) === 0) {
            return false;
        }

        // Escape any slashes in the URL so the regex match doesn't get confused
        $routeUriWithEscapedSlashes = str_replace('/', '\/', $routeUri);

        // Replace any {placeholders} in the URI with (\w+), this will allow us to do a URL match
        $matchRegex = preg_replace('#\{([\w_]+)\}#', '(\w+)', $routeUriWithEscapedSlashes);

        return preg_match("#^{$matchRegex}$#", $requestUri, $matches) === 1;
    }
}
