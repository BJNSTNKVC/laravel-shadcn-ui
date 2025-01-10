<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CardHeaderTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header></x-card-header>
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="flex flex-col space-y-1.5 p-6">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header class="bg-red-500"></x-card-header>
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="flex flex-col space-y-1.5 p-6 bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header>
                    <div>Hello World</div>
                </x-card-header>
            </x-card>
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
            <x-card>
                <x-card-header as-child>
                    <section></section>                
                </x-card-header>
            </x-card>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="flex flex-col space-y-1.5 p-6">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="flex flex-col space-y-1.5 p-6">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
