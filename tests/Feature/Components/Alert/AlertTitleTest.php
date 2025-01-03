<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Alert;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AlertTitleTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-alert>
                <x-alert-title></x-alert-title>
            </x-alert>
        HTML;

        $this->assertStringContainsString(
            needle  : '<h5 class="mb-1 font-medium leading-none tracking-tight">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-alert>
                <x-alert-title class="bg-red-500"></x-alert-title>
            </x-alert>
        HTML;

        $this->assertStringContainsString(
            needle  : '<h5 class="mb-1 font-medium leading-none tracking-tight bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-alert>
                <x-alert-title>
                    <div>Hello World</div>      
                </x-alert-title>
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
                <x-alert-title as-child>
                    <p></p>      
                </x-alert-title>
            </x-alert>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<h5 class="mb-1 font-medium leading-none tracking-tight">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<p class="mb-1 font-medium leading-none tracking-tight">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
