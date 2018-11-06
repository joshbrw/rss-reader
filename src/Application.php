<?php

namespace Joshbrw\RSS;

use Joshbrw\RSS\Bootstrap\Bootstrapper;
use Joshbrw\RSS\Exceptions\Bootstrap\InvalidBootstrapperException;
use Joshbrw\RSS\Routing\Request;
use Joshbrw\RSS\Routing\Route;
use Joshbrw\RSS\Routing\Router;
use Joshbrw\RSS\Services\Http\RequestFactory;
use Joshbrw\RSS\Services\Routing\RouteMatcher;

final class Application
{
    /**
     * @var \Joshbrw\RSS\Container
     */
    private $container;

    /**
     * @var array
     */
    private $bootstrappers;

    public function __construct(Container $container, array $bootstrappers)
    {
        $this->container = $container;
        $this->bootstrappers = $bootstrappers;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @throws InvalidBootstrapperException
     */
    public function boot(): void
    {
        $this->bootstrap();

        $request = $this->getRequest();

        $this->container->bindSingleton(Route::class, function () use ($request) {
            return $this->getMatchingRoute($request);
        });

        dd($this->container->make(Route::class));

        // Bootstrap the Application
        //  - Run the routes
        //  - Bind any services to the DI Container
        // Create an instance of the HTTP Request
        // Run it through the Router
        // Return the Response
    }

    /**
     * @throws InvalidBootstrapperException
     */
    private function bootstrap(): void
    {
        foreach ($this->bootstrappers as $bootstrapper) {
            if (!$bootstrapper instanceof Bootstrapper) {
                throw new InvalidBootstrapperException('All bootstrappers should implement the Bootstrapper interface.');
            }

            $bootstrapper->run($this);
        }
    }

    private function getRequest(): Request
    {
        return RequestFactory::fromCurrentRequest();
    }

    /**
     * @throws Exceptions\ContainerBindingNotFoundException
     * @throws Exceptions\Routing\RouteNotFoundException
     */
    private function getMatchingRoute(Request $request): Route
    {
        return RouteMatcher::match($request, $this->container->make(Router::class)->all());
    }
}
