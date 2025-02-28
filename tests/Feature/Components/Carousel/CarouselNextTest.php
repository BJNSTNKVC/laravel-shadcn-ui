<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselNext;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CarouselNextTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content>
                    <x-carousel-item></x-carousel-item>
                </x-carousel-content>
                <x-carousel-previous></x-carousel-previous>
                <x-carousel-next></x-carousel-next>
            </x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground absolute h-8 w-8 rounded-full -right-12 top-1/2 -translate-y-1/2" role="group" aria-roledescription="slide" x-bind="next">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content>
                    <x-carousel-item></x-carousel-item>
                </x-carousel-content>
                <x-carousel-previous></x-carousel-previous>
                <x-carousel-next class="bg-red-500"></x-carousel-next>
            </x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground absolute h-8 w-8 rounded-full -right-12 top-1/2 -translate-y-1/2 bg-red-500" role="group" aria-roledescription="slide" x-bind="next">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content>
                    <x-carousel-item></x-carousel-item>
                </x-carousel-content>
                <x-carousel-previous></x-carousel-previous>
                <x-carousel-next>
                    <div>Hello World</div>
                </x-carousel-next>
            </x-carousel>
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
            <x-carousel>
                <x-carousel-content>
                    <x-carousel-item></x-carousel-item>        
                    <x-carousel-previous></x-carousel-previous>        
                    <x-carousel-next as-child>
                        <section></section>
                    </x-carousel-next>        
                </x-carousel-content>
            </x-carousel>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<button class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground absolute h-8 w-8 rounded-full -right-12 top-1/2 -translate-y-1/2" role="group" aria-roledescription="slide" x-bind="next">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground absolute h-8 w-8 rounded-full -right-12 top-1/2 -translate-y-1/2" role="group" aria-roledescription="slide" x-bind="next">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}