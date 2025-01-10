<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CardContentTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header>
                    <x-card-title></x-card-title>
                    <x-card-description></x-card-description>
                </x-card-header>
                <x-card-content></x-card-content>
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="p-6 pt-0">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header>
                    <x-card-title></x-card-title>
                    <x-card-description></x-card-description>
                </x-card-header>
                <x-card-content class="bg-red-500"></x-card-content>
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="p-6 pt-0 bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header>
                    <x-card-title></x-card-title>
                    <x-card-description></x-card-description>
                </x-card-header>
                <x-card-content>
                    <div>Hello World</div>
                </x-card-content>
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
                <x-card-header>
                    <x-card-title></x-card-title>
                    <x-card-description></x-card-description>
                </x-card-header>
                <x-card-content as-child>
                    <section></section>
                </x-card-content>
            </x-card>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="p-6 pt-0">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="p-6 pt-0">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
