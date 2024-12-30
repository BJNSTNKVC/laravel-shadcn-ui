<?php

namespace Bjnstnkvc\ShadcnUi\Tests;

use Bjnstnkvc\ShadcnUi\ShadcnUiServiceProvider;
use Bjnstnkvc\ShadcnUi\Tests\Support\Template;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Orchestra\Testbench\Dusk\TestCase;

class DuskTestCase extends TestCase
{
    /**
     * Get package providers.
     *
     * @param Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            ShadcnUiServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param Application $app
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('app.key', 'base64:2MmNIr+BAz/auPFTDwPAQnsXnh2VSNaOiB7iWRIZeFg=');
        $app['config']->set('app.env', env('APP_ENV', 'testing'));
        $app['config']->set('app.debug', env('APP_DEBUG', true));
        $app['config']->set('app.url', $this->applicationBaseUrl());
    }

    /**
     * Define web routes setup.
     *
     * @param Router $router
     *
     * @return void
     */
    protected function defineWebRoutes($router): void
    {
        $router->get('/shadcn-ui', fn(Request $request) => (new Template(...$request->all()))->render())->name('shadcn-ui.component');
    }

    /**
     * Ensure the directories we need for dusk exist, and set them for the Browser to use.
     *
     * @return void
     */
    protected function prepareDirectories(): void
    {
        // Disable debug directories.
    }

    /**
     * Capture failure screenshots for each browser.
     *
     * @param Collection $browsers
     *
     * @return void
     */
    protected function captureFailuresFor($browsers)
    {
        // Disable failure screenshots.
    }

    /**
     * Store the console output for the given browsers.
     *
     * @param Collection $browsers
     *
     * @return void
     */
    protected function storeConsoleLogsFor($browsers)
    {
        // Disable console logs.
    }

    /**
     * Capture screenshots for each browser.
     *
     * @param Collection $browsers
     *
     * @return void
     */
    protected function captureScreenshotsFor($browsers)
    {
        // Disable screenshots.
    }

    /**
     * Get component route.
     *
     * @param string       $component
     * @param array|string $scripts
     *
     * @return string
     */
    protected function component(string $component, array|string $scripts = []): string
    {
        return route(
            name      : 'shadcn-ui.component',
            parameters: [
                'component' => $component,
                'scripts'   => $scripts,
            ],
            absolute  : false
        );
    }
}
