<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CollapsibleTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-collapsible></x-collapsible>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div data-state="closed" x-data="collapsible">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-collapsible open disabled></x-collapsible>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div data-state="open" data-disabled="" x-data="collapsible">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-collapsible>
                <div>Hello World</div>
            </x-collapsible>
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
            <x-collapsible as-child>
                <section></section>
            </x-collapsible>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div data-state="closed" x-data="collapsible">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section data-state="closed" x-data="collapsible">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
