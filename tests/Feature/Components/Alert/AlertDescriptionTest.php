<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Alert;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AlertDescriptionTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-alert>
                <x-alert-title></x-alert-title>
                <x-alert-description></x-alert-description>
            </x-alert>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="text-sm [&_p]:leading-relaxed">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-alert>
                <x-alert-title></x-alert-title>
                <x-alert-description class="bg-red-500"></x-alert-description>
            </x-alert>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="text-sm [&_p]:leading-relaxed bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-alert>
                <x-alert-title></x-alert-title>
                <x-alert-description>
                    <div>Hello World</div>    
                </x-alert-description>
            </x-alert>
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
            <x-alert>
                <x-alert-title></x-alert-title>
                <x-alert-description as-child>
                    <p></p>
                </x-alert-description>
            </x-alert>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="text-sm [&_p]:leading-relaxed">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<p class="text-sm [&_p]:leading-relaxed">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
