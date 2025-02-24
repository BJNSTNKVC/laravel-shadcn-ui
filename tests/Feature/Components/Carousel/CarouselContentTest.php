<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselContent;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CarouselContentTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content></x-carousel-content>
            </x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="overflow-hidden" x-ref="content">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content class="bg-red-500"></x-carousel-content>
            </x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="overflow-hidden bg-red-500" x-ref="content">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-carousel>
                <x-carousel-content>
                    <div>Hello World</div>      
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
                <x-carousel-content as-child>
                    <section></section>      
                </x-carousel-content>
            </x-carousel>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="flex -ml-4">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="flex -ml-4">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
