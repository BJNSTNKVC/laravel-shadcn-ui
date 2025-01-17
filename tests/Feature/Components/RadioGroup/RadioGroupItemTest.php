<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupItemTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-radio-group>
                <x-radio-group-item></x-radio-group-item>
            </x-radio-group>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="aspect-square h-4 w-4 rounded-full border border-primary text-primary disabled:cursor-not-allowed disabled:opacity-50 ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" type="button" role="radio" aria-checked="false" data-state="unchecked" x-ref="radio">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-radio-group value="item-1">
                <x-radio-group-item value="item-1"></x-radio-group-item>
            </x-radio-group>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="aspect-square h-4 w-4 rounded-full border border-primary text-primary disabled:cursor-not-allowed disabled:opacity-50 ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" type="button" role="radio" aria-checked="true" data-state="checked" value="item-1" x-ref="radio">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_does_not_render_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-radio-group>
                <x-radio-group-item>
                    <div>Hello World</div>
                </x-radio-group-item>
            </x-radio-group>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div>Hello World</div>',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_as_child()
    {
        $template = <<<'HTML'
            <x-radio-group>
                <x-radio-group-item as-child>
                    <section></section>
                </x-radio-group-item>
            </x-radio-group>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<button class="aspect-square h-4 w-4 rounded-full border border-primary text-primary disabled:cursor-not-allowed disabled:opacity-50 ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" type="button" role="radio" aria-checked="false" data-state="unchecked" x-ref="radio">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="aspect-square h-4 w-4 rounded-full border border-primary text-primary disabled:cursor-not-allowed disabled:opacity-50 ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2" type="button" role="radio" aria-checked="false" data-state="unchecked" x-ref="radio">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
