<?php

namespace Photogabble\LumenFormRequest\Tests;

use App\Exceptions\Handler;
use Exception;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Laravel\Lumen\Application;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;
use Photogabble\LumenFormRequest\LumenFormGeneratorServiceProvider;

abstract class TestCase extends \Laravel\Lumen\Testing\TestCase
{

    /**
     * Creates the application.
     *
     * @return Application
     * @throws Exception
     */
    public function createApplication(): Application
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
        $tmpDirectory = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test_' . substr($random, 0, 32);

        if (! mkdir($tmpDirectory)) {
            throw new Exception('Could not create temporary directory ['. $tmpDirectory .']');
        }

        mkdir ($tmpDirectory . '/app');

        copy(__DIR__ . '/composer_stub.json', $tmpDirectory . '/composer.json');

        (new LoadEnvironmentVariables(
            $tmpDirectory
        ))->bootstrap();

        $app = new Application(
            $tmpDirectory
        );

        // Using Artisan Facade for testing command with
        $app->withFacades();

        // Configure an Exception Handler
        $app->singleton(
            ExceptionHandler::class,
            \Laravel\Lumen\Exceptions\Handler::class
        );

        // Setup the Artisan Kernel with the Lumen base one
        $app->singleton(
            Kernel::class,
            \Laravel\Lumen\Console\Kernel::class
        );

        $app->register(LumenFormGeneratorServiceProvider::class);

        return $app;
    }
}
