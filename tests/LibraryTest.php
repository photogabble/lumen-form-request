<?php

namespace Photogabble\LumenFormRequest\Tests;

class LibraryTest extends TestCase
{
    public function test_request_validation_returns_422_on_failure()
    {
        $tFramework = $this;
        $this->app->router->post('/test', function (MockApiRequest $request) use ($tFramework) {
            $tFramework->assertTrue(false, 'route method should not execute on validation error');
        });

        $request = $this->post('/test');
        $request->assertResponseStatus(422);
    }

    public function test_request_validation_returns_200_on_success()
    {
        $tFramework = $this;

        $this->app->router->post('/test', function (MockApiRequest $request) use ($tFramework) {
            $tFramework->assertInstanceOf(MockApiRequest::class, $request);
            return 'pass';
        });

        $request = $this->post('/test', ['hello' => 'world']);
        $request->assertResponseOk();
        $this->assertEquals('pass', $request->response->getContent());
    }
}