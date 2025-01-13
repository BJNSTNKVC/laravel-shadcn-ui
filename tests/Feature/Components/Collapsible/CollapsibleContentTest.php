<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CollapsibleContentTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-collapsible>
                <x-collapsible-trigger></x-collapsible-trigger>
                <x-collapsible-content></x-collapsible-content>
            </x-collapsible>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div id="collapsible-1" data-state="closed" hidden="hidden" x-ref="content">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-collapsible open disabled>
                <x-collapsible-trigger></x-collapsible-trigger>
                <x-collapsible-content></x-collapsible-content>
            </x-collapsible>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div id="collapsible-1" data-state="open" data-disabled="" x-ref="content">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-collapsible>
                <x-collapsible-trigger></x-collapsible-trigger>
                <x-collapsible-content>
                    <div>Hello World</div>  
                </x-collapsible-content>
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
            <x-collapsible>
                <x-collapsible-trigger></x-collapsible-trigger>
                <x-collapsible-content as-child>
                    <section></section>
                </x-collapsible-content>
            </x-collapsible>
        HTML;

        $render = $this->minify($this->blade($template));

        $this->assertStringNotContainsString(
            needle  : '<div id="collapsible-1" data-state="closed" hidden="hidden" x-ref="content">',
            haystack: $render,
        );

        $this->assertStringContainsString(
            needle  : '<section id="collapsible-1" data-state="closed" hidden="hidden" x-ref="content">',
            haystack: $render,
        );
    }
}
