<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Label;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class LabelTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-label></x-label>
        HTML;

        $this->assertStringContainsString(
            needle  : '<label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-label for="email"></x-label>
        HTML;

        $this->assertStringContainsString(
            needle  : '<label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="email">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-label>
                <div>Hello World</div>
            </x-label>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div>Hello World</div>',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_as_child()
    {
        $template = <<<'HTML'
            <x-label as-child>
                <div></div>
            </x-label>
        HTML;

        $render = $this->minify($this->blade($template));

        $this->assertStringNotContainsString(
            needle  : '<label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">',
            haystack: $render,
        );

        $this->assertStringContainsString(
            needle  : '<div class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">',
            haystack: $render,
        );
    }
}
