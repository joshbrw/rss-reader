<?php

namespace Joshbrw\RSS;

use Joshbrw\RSS\Exceptions\ContainerBindingNotFoundException;

final class Container
{
    private $singletons = [];

    private $resolvedSingletons = [];

    private $bindings = [];

    public function bindSingleton(string $abstract, callable $concrete): Container
    {
        $this->singletons[$abstract] = $concrete;

        return $this;
    }

    public function bind(string $abstract, callable $concrete): Container
    {
        $this->bindings[$abstract] = $concrete;

        return $this;
    }

    /** @throws ContainerBindingNotFoundException */
    public function make(string $abstract)
    {
        if ($this->hasResolvedSingleton($abstract)) {
            return $this->resolvedSingletons[$abstract];
        }

        if ($this->hasUnresolvedSingleton($abstract)) {
            return $this->resolveSingleton($abstract);
        }

        if (array_key_exists($abstract, $this->bindings)) {
            return $this->bindings[$abstract]();
        }

        throw ContainerBindingNotFoundException::fromInvalidBindingName($abstract);
    }

    /** @throws ContainerBindingNotFoundException */
    private function resolveSingleton(string $abstract)
    {
        if (!$this->hasUnresolvedSingleton($abstract)) {
            throw ContainerBindingNotFoundException::fromInvalidBindingName($abstract);
        }

        $this->resolvedSingletons[$abstract] = $this->singletons[$abstract]();

        unset($this->singletons[$abstract]);

        return $this->resolvedSingletons[$abstract];
    }

    private function hasResolvedSingleton(string $abstract): bool
    {
        return array_key_exists($abstract, $this->resolvedSingletons);
    }

    private function hasUnresolvedSingleton(string $abstract): bool
    {
        return array_key_exists($abstract, $this->singletons);
    }
}
