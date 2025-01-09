<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-breadcrumb></x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<nav aria-label="breadcrumb">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-breadcrumb class="bg-red-500"></x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<nav aria-label="breadcrumb" class="bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <div>Hello World</div>
            </x-breadcrumb>
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
            <x-breadcrumb as-child>
                <section></section>
            </x-breadcrumb>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<nav aria-label="breadcrumb">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section aria-label="breadcrumb">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
