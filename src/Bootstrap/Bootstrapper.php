<?php

namespace Joshbrw\RSS\Bootstrap;

use Joshbrw\RSS\Application;

interface Bootstrapper
{
    public function run(Application $application): void;
}
