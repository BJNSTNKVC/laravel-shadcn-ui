<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Avatar;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AvatarTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-avatar>
                <x-avatar-image />
                <x-avatar-fallback />
            </x-avatar>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full" x-data="avatar({"delay":0})">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-avatar class="bg-red-500">
                <x-avatar-image />
                <x-avatar-fallback />
            </x-avatar>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full bg-red-500" x-data="avatar({"delay":0})">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-avatar>
                <x-avatar-image />
                <x-avatar-fallback />
                <div>Hello World</div>
            </x-avatar>
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
            <x-avatar as-child>
                <section>
                    <x-avatar-image />
                    <x-avatar-fallback />
                </section>
            </x-avatar>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full" x-data="avatar({"delay":0})">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full" x-data="avatar({"delay":0})">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
