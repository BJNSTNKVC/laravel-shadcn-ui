<?php

namespace Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AccordionContentTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-accordion>
                <x-accordion-item value="item-1">
                    <x-accordion-trigger></x-accordion-trigger>
                    <x-accordion-content></x-accordion-content>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="overflow-hidden transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down" id="accordion-item-1" role="region" aria-labelledby="accordion-item-1" aria-expanded="false" data-orientation="vertical" data-state="closed" hidden="">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-accordion orientation="horizontal" value="item-1">
                <x-accordion-item value="item-1">
                    <x-accordion-trigger></x-accordion-trigger>
                    <x-accordion-content></x-accordion-content>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="overflow-hidden transition-all data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down" id="accordion-item-1" role="region" aria-labelledby="accordion-item-1" aria-expanded="true" data-orientation="horizontal" data-state="open">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-accordion>
                <x-accordion-item value="item-1">
                    <x-accordion-trigger></x-accordion-trigger>
                    <x-accordion-content>
                        <div>Hello World</div>
                    </x-accordion-content>
                </x-accordion-item>
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
            <x-accordion>
                <x-accordion-item value="item-1">
                    <x-accordion-trigger></x-accordion-trigger>
                    <x-accordion-content as-child>
                        <section class="pb-4 pt-0"></section>
                    </x-accordion-content>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="pb-4 pt-0">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="pb-4 pt-0">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
