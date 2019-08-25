<?php

namespace Photogabble\LumenFormRequest;

use Laravel\Lumen\Application;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class LumenFormGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->afterResolving(ValidatesWhenResolved::class, function (ValidatesWhenResolved $resolved) {
            $resolved->validateResolved();
        });
        $this->app->resolving(ApiRequest::class, function (ApiRequest $request, Application $app) {
            $this->initializeRequest($request, $app['request']);
            $request->setContainer($app);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.make.form-request', function ($app) {
            return new Console\MakeRequestCommand($app['files']);
        });

        $this->commands([
            'command.make.form-request'
        ]);
    }

    /**
     * Initialize the form request with data from the given request.
     *
     * @param ApiRequest $form
     * @param Request $current
     * @return void
     */
    protected function initializeRequest(ApiRequest $form, Request $current)
    {
        $files = $current->files->all();
        $files = is_array($files) ? array_filter($files) : $files;
        $form->initialize(
            $current->query->all(), $current->request->all(), $current->attributes->all(),
            $current->cookies->all(), $files, $current->server->all(), $current->getContent()
        );
        $form->setJson($current->json());
        $form->setUserResolver($current->getUserResolver());
        $form->setRouteResolver($current->getRouteResolver());
    }
}