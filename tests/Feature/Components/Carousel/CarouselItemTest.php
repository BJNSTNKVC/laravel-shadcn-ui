<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CarouselItemTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content>
                    <x-carousel-item></x-carousel-item>
                </x-carousel-content>
            </x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="min-w-0 shrink-0 grow-0 basis-full pl-4" role="group" aria-roledescription="slide">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content>
                    <x-carousel-item class="bg-red-500"></x-carousel-item>
                </x-carousel-content>
            </x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="min-w-0 shrink-0 grow-0 basis-full pl-4 bg-red-500" role="group" aria-roledescription="slide">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content>
                    <x-carousel-item>
                        <div>Hello World</div>
                    </x-carousel-item>      
                </x-carousel-content>
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
                    <x-carousel-item as-child>
                        <section></section>
                    </x-carousel-item>        
                </x-carousel-content>
            </x-carousel>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="min-w-0 shrink-0 grow-0 basis-full pl-4" role="group" aria-roledescription="slide">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="min-w-0 shrink-0 grow-0 basis-full pl-4" role="group" aria-roledescription="slide">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
