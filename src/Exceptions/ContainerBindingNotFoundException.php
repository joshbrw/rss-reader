<?php

namespace Joshbrw\RSS\Exceptions;

use Exception;

class ContainerBindingNotFoundException extends Exception
{
    public static function fromInvalidBindingName(string $binding): self
    {
        return new self("The binding '{$binding}' was not found.");
    }
}
