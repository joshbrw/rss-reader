<?php

use Joshbrw\RSS\Container;

if (!function_exists('container')) {
    /**
     * Use service location to retrieve the singleton instance of the DI Container
     * @return Container
     */
    function container(): Container
    {
        return Container::getInstance();
    }
}
