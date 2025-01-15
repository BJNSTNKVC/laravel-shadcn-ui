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
            <x-button></x-button>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2 h-10 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-button variant="destructive"></x-button>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2 h-10 bg-destructive text-destructive-foreground hover:bg-destructive/90 h-10 px-4 py-2">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-button>
                <div>Hello World</div>
            </x-button>
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
            <x-button as-child>
                <section></section>
            </x-button>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2 h-10 bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2 h-10 bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
