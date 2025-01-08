<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Button;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ButtonTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-badge></x-badge>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="inline-flex items-center border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 rounded-full border-transparent bg-primary text-primary-foreground hover:bg-primary/80">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-badge variant="destructive"></x-badge>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="inline-flex items-center border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 rounded-full border-transparent bg-destructive text-destructive-foreground hover:bg-destructive/80">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-badge>
                <div>Hello World</div>
            </x-badge>
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
            <x-badge as-child>
                <section></section>
            </x-badge>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="inline-flex items-center border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 rounded-full border-transparent bg-primary text-primary-foreground hover:bg-primary/80">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="inline-flex items-center border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 rounded-full border-transparent bg-primary text-primary-foreground hover:bg-primary/80">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
