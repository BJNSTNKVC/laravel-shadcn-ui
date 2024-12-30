<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Support;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Testing\TestView;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;
use Illuminate\View\View;

trait InteractsWithViews
{
    /**
     * Render the contents of the given Blade template string.
     *
     * @param string          $template
     * @param Arrayable|array $data
     *
     * @return TestView
     */
    protected function blade(string $template, Arrayable|array $data = []): TestView
    {
        $tempDirectory = sys_get_temp_dir();

        if (!in_array($tempDirectory, ViewFacade::getFinder()->getPaths())) {
            ViewFacade::addLocation(sys_get_temp_dir());
        }

        $tempFileInfo = pathinfo(tempnam($tempDirectory, 'laravel-blade'));

        $tempFile = $tempFileInfo['dirname'] . '/' . $tempFileInfo['filename'] . '.blade.php';

        file_put_contents($tempFile, $template);

        return new TestView(view($tempFileInfo['filename'], $data));
    }

    /**
     * Render the given view component.
     *
     * @template TComponent of View
     *
     * @param class-string<TComponent> $class
     * @param array                    $data
     * @param array                    $attributes
     * @param array|string             $slot
     *
     * @return TComponent
     */
    protected function component(string $class, array $data = [], array $attributes = [], array|string $slot = '')
    {
        /** @var Component $component */
        $component = new $class(...$data);

        if (is_string($slot)) {
            $slot = [$slot];
        }

        $component = $component->render()
            ->with([
                ...$component->data(),
                'attributes' => new ComponentAttributeBag($attributes),
                'slot'       => new ComponentSlot(implode(PHP_EOL, $slot)),
            ]);

        $component->render();

        return $component;
    }

    /**
     * Minify the given string.
     *
     * @param string $string
     *
     * @return string
     */
    protected function minify(string $string): string
    {
        return preg_replace(
            pattern    : ['/>\s+</', '/\s+/'],
            replacement: ['><', ' '],
            subject    : html_entity_decode($string)
        );
    }
}
