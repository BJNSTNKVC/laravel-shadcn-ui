<?php

namespace Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AccordionTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-accordion></x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div data-orientation="vertical" x-data="accordion({"type":"single","collapsible":false,"direction":"ltr"})"></div>',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-accordion type="multiple" orientation="horizontal" direction="rtl" collapsible></x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div data-orientation="horizontal" x-data="accordion({"type":"multiple","collapsible":true,"direction":"rtl"})"></div>',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-accordion>
                <div>Hello World</div>
            </x-accordion>
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
            <x-accordion type="multiple" orientation="horizontal" direction="rtl" collapsible as-child>
                <section></section>
            </x-accordion>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div data-orientation="horizontal" x-data="accordion({"type":"multiple","collapsible":true,"direction":"rtl"})"></div>',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section data-orientation="horizontal" x-data="accordion({"type":"multiple","collapsible":true,"direction":"rtl"})">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
