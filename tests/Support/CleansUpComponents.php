<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Support;

use Illuminate\Filesystem\Filesystem;

trait CleansUpComponents
{
    /**
     * Filesystem instance.
     *
     * @var Filesystem
     */
    private static Filesystem $fs;

    /**
     * Remove the generated Component classes.
     *
     * @return void
     */
    protected function cleanUp(): void
    {
        self::$fs ??= new Filesystem();

        self::$fs->deleteDirectory(app_path('View'));
        self::$fs->deleteDirectory(resource_path('views/components'));
        self::$fs->deleteDirectory(resource_path('js/components'));

        foreach (self::$fs->glob(app_path("../../src/View/Components/*/.published")) as $file) {
            self::$fs->delete($file);
        }
    }
}
