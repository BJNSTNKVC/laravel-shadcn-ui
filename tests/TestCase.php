<?php

namespace Bjnstnkvc\ShadcnUi\Tests;

use Bjnstnkvc\ShadcnUi\ShadcnUiServiceProvider;
use Bjnstnkvc\ShadcnUi\Tests\Support\InteractsWithViews;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use InteractsWithViews;

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
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app->setBasePath(__DIR__ . '/../workbench');
    }
}