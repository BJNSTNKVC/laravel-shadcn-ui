<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-radio-group></x-radio-group>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="grid gap-2" style="outline: none;" role="radiogroup" aria-required="false" dir="ltr" tabindex="0" x-data="radiogroup({"loop":true})">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-radio-group loop="false" required disabled></x-radio-group>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="grid gap-2" style="outline: none;" role="radiogroup" aria-required="true" data-disabled="" disabled="" dir="ltr" tabindex="0" x-data="radiogroup({"loop":false})">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-radio-group>
                <div>Hello World</div>
            </x-radio-group>
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
            <x-radio-group as-child>
                <section></section>
            </x-radio-group>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="grid gap-2" style="outline: none;" role="radiogroup" aria-required="false" dir="ltr" tabindex="0" x-data="radiogroup({"loop":true})">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="grid gap-2" style="outline: none;" role="radiogroup" aria-required="false" dir="ltr" tabindex="0" x-data="radiogroup({"loop":true})">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
