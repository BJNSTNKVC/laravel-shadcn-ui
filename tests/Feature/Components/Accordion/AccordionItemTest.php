<?php

namespace Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AccordionItemTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-accordion>
                <x-accordion-item value="item-1"></x-accordion-item>
            </x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="border-b" data-orientation="vertical" data-state="closed" x-init="set(\'accordion-item-1\', \'item-1\')">',
            haystack: $this->minify($this->blade($template)),
            message : 'The Accordion Item component is not rendered.'
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-accordion orientation="horizontal" value="item-1">
                <x-accordion-item value="item-1"></x-accordion-item>
            </x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="border-b" data-orientation="horizontal" data-state="open" x-init="set(\'accordion-item-1\', \'item-1\')">',
            haystack: $this->minify($this->blade($template)),
            message : 'The Accordion Item component with props is not rendered.'
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-accordion>
                <x-accordion-item value="item-1">
                    <div>Hello World</div>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div>Hello World</div>',
            haystack: $this->minify($this->blade($template)),
            message : 'The Accordion Item component with slot is not rendered.'
        );
    }

    #[Test]
    public function it_renders_the_component_as_child()
    {
        $template = <<<'HTML'
            <x-accordion>
                <x-accordion-item value="item-1" as-child>
                    <section></section>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->assertStringContainsString(
            needle  : '<section class="border-b" data-orientation="vertical" data-state="closed" x-init="set(\'accordion-item-1\', \'item-1\')">',
            haystack: $this->minify($this->blade($template)),
            message : 'The Accordion Item component is not rendered as child.'
        );
    }
}
