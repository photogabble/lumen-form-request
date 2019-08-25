<?php

namespace Photogabble\LumenFormRequest\Tests;

use Laravel\Lumen\Application;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;
use Photogabble\LumenFormRequest\LumenFormGeneratorServiceProvider;

abstract class TestCase extends \Laravel\Lumen\Testing\TestCase
{

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        (new LoadEnvironmentVariables(
            dirname(__DIR__)
        ))->bootstrap();

        $app = new Application(
            dirname(__DIR__)
        );

        $app->register(LumenFormGeneratorServiceProvider::class);

        return $app;
    }
}
