<?php

namespace Bjnstnkvc\ShadcnUi\Tests;

use Bjnstnkvc\ShadcnUi\ShadcnUiServiceProvider;
use Illuminate\Foundation\Application;
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
}
