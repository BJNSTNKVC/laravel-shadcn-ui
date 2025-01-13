<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CollapsibleTriggerTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-collapsible>
                <x-collapsible-trigger></x-collapsible-trigger>
            </x-collapsible>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button id="collapsible-1" type="button" aria-controls="collapsible-1" aria-expanded="false" data-state="closed" x-ref="trigger">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-collapsible open disabled>
                <x-collapsible-trigger></x-collapsible-trigger>
            </x-collapsible>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button id="collapsible-1" type="button" aria-controls="collapsible-1" aria-expanded="true" data-state="open" data-disabled="" disabled="" x-ref="trigger">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-collapsible>
                <x-collapsible-trigger>
                    <div>Hello World</div>
                </x-collapsible-trigger>
            </x-collapsible>
        HTML;

        $this->blade($template)
            ->assertSee(
                value : '<div>Hello World</div>',
                escape: false
            );
    }

    #[Test]
    public function it_renders_the_component_as_child()
    {
        $template = <<<'HTML'
            <x-collapsible>
                <x-collapsible-trigger as-child>
                    <div></div>
                </x-collapsible-trigger>
            </x-collapsible>
        HTML;

        $render = $this->minify($this->blade($template));

        $this->assertStringNotContainsString(
            needle  : '<button id="collapsible-1" type="button" aria-controls="collapsible-1" aria-expanded="false" data-state="closed" x-ref="trigger">',
            haystack: $render,
        );

        $this->assertStringContainsString(
            needle  : '<div id="collapsible-1" type="button" aria-controls="collapsible-1" aria-expanded="false" data-state="closed" x-ref="trigger">',
            haystack: $render,
        );
    }
}
