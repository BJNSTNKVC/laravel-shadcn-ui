<?php

namespace Bjnstnkvc\ShadcnUi;

use Bjnstnkvc\ShadcnUi\Console\Commands;
use Bjnstnkvc\ShadcnUi\View\Components;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ShadcnUiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\AddComponentCommand::class,
                Commands\RemoveComponentCommand::class,
            ]);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootComponents();
        $this->bootPublishing();
    }

    /**
     * Bootstrap the blade components.
     *
     * @return void
     */
    private function bootComponents(): void
    {
        if ($this->app->runningUnitTests()) {
            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'shadcn-ui');

            $directory = __DIR__ . '/View/Components';
            $paths     = $this->files($directory);

            foreach ($paths as $path) {
                $components = $this->files("$directory/$path");

                foreach ($components as $component) {
                    $name = Str::replace('.php', '', $component);

                    $class = Str::of($component)
                        ->replace('.php', '')
                        ->ucsplit()
                        ->map(fn(string $word) => Str::lower($word))
                        ->implode('-');

                    Blade::component($class, "Bjnstnkvc\ShadcnUi\View\Components\\$path\\$name");
                }
            }
        }
    }

    /**
     * Bootstrap configuration file publishing.
     *
     * @return void
     */
    private function bootPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                paths : [
                    __DIR__ . '/../tailwind.config.js' => $this->app->basePath('tailwind.config.js'),
                ],
                groups: 'shadcn-ui-tailwind-config'
            );
            $this->publishes(
                paths : [
                    __DIR__ . '/../jsconfig.json' => $this->app->basePath('jsconfig.json'),
                ],
                groups: 'shadcn-ui-jsconfig'
            );
        }
    }

    /**
     * Get all files in a directory.
     *
     * @param string $directory
     *
     * @return array|false
     */
    private function files(string $directory): array|false
    {
        return array_diff(scandir($directory), ['..', '.']);
    }

    /**
     * Boot Shadcn UI components.
     *
     * @return void
     */
    public static function components(): void
    {
        $fs          = new Filesystem();
        $directories = $fs->directories(__DIR__ . '/View/Components');

        foreach ($directories as $directory) {
            if (!$fs->exists("{$directory}/.published")) {
                continue;
            }

            $path       = basename($directory);
            $components = $fs->files($directory);

            foreach ($components as $component) {
                $name = Str::replace('.php', '', $component->getFilename());

                $class = Str::of($name)
                    ->ucsplit()
                    ->map(fn(string $word) => Str::lower($word))
                    ->implode('-');

                Blade::component($class, "App\View\Components\\$path\\$name");
            }
        }

        Blade::component(Components\Compiler\CompileAsChild::class, 'compile-as-child');
    }
}
