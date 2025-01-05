<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Avatar;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AvatarFallbackTest extends TestCase
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
            needle  : '<span class="flex h-full w-full items-center justify-center rounded-full bg-muted" x-ref="fallback">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-avatar>
                <x-avatar-image />
                <x-avatar-fallback class="bg-red-500" />
            </x-avatar>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="flex h-full w-full items-center justify-center rounded-full bg-muted bg-red-500" x-ref="fallback">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-avatar>
                <x-avatar-image />
                <x-avatar-fallback>
                    <div>Hello World</div>
                </x-avatar-fallback>
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
            <x-avatar>
                <x-avatar-image src="https://images.unsplash.com/photo-1511485977113-f34c92461ad9" alt="Image alt text" />
                <x-avatar-fallback as-child>
                    <button></button>
                </x-avatar-fallback>
            </x-avatar>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<span class="flex h-full w-full items-center justify-center rounded-full bg-muted" x-ref="fallback">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<button class="flex h-full w-full items-center justify-center rounded-full bg-muted" x-ref="fallback"></button>',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
