<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CardDescriptionTest extends TestCase
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
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="text-sm text-muted-foreground">',
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
                    <x-card-description class="bg-red-500"></x-card-description>
                </x-card-header>
            </x-card>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div class="text-sm text-muted-foreground bg-red-500">',
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
                    <x-card-description>
                        <div>Hello World</div>
                    </x-card-description>
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
                    <x-card-title></x-card-title>
                    <x-card-description as-child>
                        <section></section>
                    </x-card-description>
                </x-card-header>
            </x-card>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<div class="text-sm text-muted-foreground">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="text-sm text-muted-foreground">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
