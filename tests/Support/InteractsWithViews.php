<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Support;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;
use Illuminate\View\View;

trait InteractsWithViews
{
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
