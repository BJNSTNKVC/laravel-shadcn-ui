<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AccordionTriggerTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-accordion>
                <x-accordion-item value="item-1">
                    <x-accordion-trigger></x-accordion-trigger>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->blade($template)
            ->assertSee(
                value : '<h3 class="flex" data-orientation="vertical">',
                escape: false
            )
            ->assertSee(
                value : '<button class="flex flex-1 items-center justify-between py-4 font-medium transition-all hover:underline text-left [&amp;[data-state=open]&gt;svg]:rotate-180" id="accordion-item-1" aria-controls="accordion-item-1" aria-expanded="false" data-orientation="vertical" data-state="closed">',
                escape: false
            );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-accordion orientation="horizontal" value="item-1">
                <x-accordion-item value="item-1">
                    <x-accordion-trigger></x-accordion-trigger>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->blade($template)
            ->assertSee(
                value : '<h3 class="flex" data-orientation="horizontal">',
                escape: false
            )
            ->assertSee(
                value : '<button class="flex flex-1 items-center justify-between py-4 font-medium transition-all hover:underline text-left [&amp;[data-state=open]&gt;svg]:rotate-180" id="accordion-item-1" aria-controls="accordion-item-1" aria-expanded="true" data-orientation="horizontal" data-state="open">',
                escape: false
            );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-accordion>
                <x-accordion-item value="item-1">
                    <x-accordion-trigger>
                        <div>Hello World</div>
                    </x-accordion-trigger>
                </x-accordion-item>
            </x-accordion>
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
            <x-accordion>
                <x-accordion-item value="item-1">
                    <x-accordion-trigger as-child>
                        <div></div>
                    </x-accordion-trigger>
                </x-accordion-item>
            </x-accordion>
        HTML;

        $this->blade($template)
            ->assertSee(
                value : '<h3 class="flex" data-orientation="vertical">',
                escape: false
            )
            ->assertDontSee(
                value : '<button class="flex flex-1 items-center justify-between py-4 font-medium transition-all hover:underline text-left [&amp;[data-state=open]&gt;svg]:rotate-180" id="accordion-item-1" aria-controls="accordion-item-1" aria-expanded="false" data-orientation="vertical" data-state="closed">',
                escape: false
            )
            ->assertSee(
                value : '<div class="flex flex-1 items-center justify-between py-4 font-medium transition-all hover:underline text-left [&amp;[data-state=open]&gt;svg]:rotate-180" id="accordion-item-1" aria-controls="accordion-item-1" aria-expanded="false" data-orientation="vertical" data-state="closed">',
                escape: false
            );
    }
}
