<?php

namespace Joshbrw\RSS\Exceptions\Bootstrap;

class InvalidRoutesFilePathException extends BootstrappingException
{
    public static function fromInvalidRoutesFilePath(string $path): InvalidRoutesFilePathException
    {
        return new self("The routes path supplied ({$path}) is invalid.");
    }
}
