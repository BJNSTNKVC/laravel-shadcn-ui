<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Checkbox;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CheckboxTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-checkbox></x-checkbox>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="peer h-4 w-4 shrink-0 rounded-sm border border-primary focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2" type="button" role="checkbox" aria-checked="null" data-state="indeterminate" value="on" x-data="checkbox">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-checkbox id="terms" value="yes" checked required></x-checkbox>
        HTML;

        $this->assertStringContainsString(
            needle  : '<button class="peer h-4 w-4 shrink-0 rounded-sm border border-primary focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2" type="button" role="checkbox" aria-checked="true" aria-required="true" data-state="checked" value="yes" x-data="checkbox" id="terms">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_does_not_render_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-checkbox>
                <div>Hello World</div>
            </x-checkbox>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div>Hello World</div>',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_as_child()
    {
        $template = <<<'HTML'
            <x-checkbox as-child>
                <section></section>
            </x-checkbox>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<button class="peer h-4 w-4 shrink-0 rounded-sm border border-primary focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2" type="button" role="checkbox" aria-checked="null" data-state="indeterminate" value="on" x-data="checkbox">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="peer h-4 w-4 shrink-0 rounded-sm border border-primary focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2" type="button" role="checkbox" aria-checked="null" data-state="indeterminate" value="on" x-data="checkbox">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
