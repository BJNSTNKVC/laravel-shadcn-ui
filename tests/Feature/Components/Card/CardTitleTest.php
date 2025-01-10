<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CardTitleTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header>
                    <x-card-title></x-card-title>
                </x-card-header>
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="font-semibold leading-none tracking-tight text-2xl">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header>
                    <x-card-title class="bg-red-500"></x-card-title>
                </x-card-header>
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="font-semibold leading-none tracking-tight text-2xl bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-card>
                <x-card-header>
                    <x-card-title>
                        <div>Hello World</div>
                    </x-card-title>
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
                <x-card-header>
                    <x-card-title as-child>
                        <section></section>
                    </x-card-title>
                </x-card-header>
            </x-card>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="font-semibold leading-none tracking-tight text-2xl">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="font-semibold leading-none tracking-tight text-2xl">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
