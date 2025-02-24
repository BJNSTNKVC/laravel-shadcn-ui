<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CarouselTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-carousel></x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="relative" role="region" aria-roledescription="carousel" x-data="carousel({"orientation":"horizontal"}, [])">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-carousel orientation="vertical"></x-carousel>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="relative" role="region" aria-roledescription="carousel" x-data="carousel({"orientation":"vertical"}, [])">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-carousel>
                <div>Hello World</div>
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
            <x-carousel as-child>
                <section></section>
            </x-carousel>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="relative" role="region" aria-roledescription="carousel" x-data="carousel({"orientation":"horizontal"}, [])">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="relative" role="region" aria-roledescription="carousel" x-data="carousel({"orientation":"horizontal"}, [])">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
