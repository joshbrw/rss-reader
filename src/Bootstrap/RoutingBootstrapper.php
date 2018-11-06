<?php

namespace Joshbrw\RSS\Bootstrap;

use Joshbrw\RSS\Application;
use Joshbrw\RSS\Exceptions\Bootstrap\InvalidRouteException;
use Joshbrw\RSS\Exceptions\Bootstrap\InvalidRoutesFilePathException;
use Joshbrw\RSS\Routing\Route;
use Joshbrw\RSS\Routing\Router;

class RoutingBootstrapper implements Bootstrapper
{

    /**
     * @var string
     */
    private $pathToRoutesFile;

    public function __construct(string $pathToRoutesFile)
    {
        $this->pathToRoutesFile = $pathToRoutesFile;
    }

    /** @throws InvalidRoutesFilePathException */
    public function run(Application $application): void
    {
        if (!file_exists($this->pathToRoutesFile)) {
            throw InvalidRoutesFilePathException::fromInvalidRoutesFilePath($this->pathToRoutesFile);
        }

        $application->getContainer()->bindSingleton(Router::class, function () {
            return new Router;
        });

        $routes = require_once $this->pathToRoutesFile;

        $this->hydrateRouterWithRoutes(
          $application->getContainer()->make(Router::class),
          $routes
        );
    }

    private function hydrateRouterWithRoutes(
      Router $router,
      array $routes = []
    ) {
        foreach ($routes as $route) {
            if (!$route instanceof Route) {
                throw new InvalidRouteException('The routes.php file should return an array of Route instances');
            }

            $router->registerRoute($route);
        }
    }
}
