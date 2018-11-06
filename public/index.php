<?php

/**
 * This file acts as the front-controller for the application.
 */

use Joshbrw\RSS\Application;
use Joshbrw\RSS\Bootstrap\RepositoryBootstrapper;
use Joshbrw\RSS\Bootstrap\RoutingBootstrapper;
use Joshbrw\RSS\Container;

define('PUBLIC_ROOT', __DIR__);
define('ROOT_DIR', dirname(__DIR__));
define('SRC_DIR', ROOT_DIR . "/src");

require_once ROOT_DIR . '/vendor/autoload.php';

$container = new Container();
$application = new Application(
  $container,
  [
    new RoutingBootstrapper(SRC_DIR . '/Http/routes.php'),
    new RepositoryBootstrapper,
  ]
);
$application->boot();
