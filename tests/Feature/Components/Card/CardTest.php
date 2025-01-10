<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CardTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-card></x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="border bg-card text-card-foreground rounded-lg shadow-sm">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-card class="bg-red-500"></x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="border bg-card text-card-foreground rounded-lg shadow-sm bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-card>
                <div>Hello World</div>
            </x-card>
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
            <x-card as-child>
                <section></section>
            </x-card>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="border bg-card text-card-foreground rounded-lg shadow-sm">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="border bg-card text-card-foreground rounded-lg shadow-sm">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
