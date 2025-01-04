<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\AspectRatio;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AspectRatioTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-aspect-ratio></x-aspect-ratio>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div aspect-ratio-wrapper="" style="position: relative; width: 100%; padding-bottom: 100%;">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-aspect-ratio :ratio="16 / 9"></x-aspect-ratio>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div aspect-ratio-wrapper="" style="position: relative; width: 100%; padding-bottom: 56.25%;">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-aspect-ratio>
                <div>Hello World</div>
            </x-aspect-ratio>
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
            <x-aspect-ratio as-child>
                <img alt="A placeholder image" src="https://images.unsplash.com/photo-1535025183041-0991a977e25b">
            </x-aspect-ratio>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="relative w-full rounded-lg border [&>svg~*]:pl-7 [&>svg+div]:translate-y-[-3px] [&>svg]:absolute [&>svg]:left-4 [&>svg]:top-4 [&>svg]:text-foreground p-4 bg-background text-foreground" role="alert">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<img style="position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;" alt="A placeholder image" src="https://images.unsplash.com/photo-1535025183041-0991a977e25b">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
