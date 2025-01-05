<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Avatar;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AvatarImageTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-avatar>
                <x-avatar-image src="https://images.unsplash.com/photo-1511485977113-f34c92461ad9" />
                <x-avatar-fallback />
            </x-avatar>
        HTML;

        $this->assertStringContainsString(
            needle  : '<img class="aspect-square h-full w-full" x-ref="image" hidden="" src="https://images.unsplash.com/photo-1511485977113-f34c92461ad9">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-avatar>
                <x-avatar-image src="https://images.unsplash.com/photo-1511485977113-f34c92461ad9" alt="Image alt text" />
                <x-avatar-fallback />
            </x-avatar>
        HTML;

        $this->assertStringContainsString(
            needle  : '<img class="aspect-square h-full w-full" x-ref="image" hidden="" src="https://images.unsplash.com/photo-1511485977113-f34c92461ad9" alt="Image alt text">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_as_child()
    {
        $template = <<<'HTML'
            <x-avatar>
                <x-avatar-image as-child>
                    <div>
                        <img src="https://images.unsplash.com/photo-1511485977113-f34c92461ad9" alt="Image alt text" />
                    </div>
                </x-avatar-image>
                <x-avatar-fallback />
            </x-avatar>
        HTML;

        $this->assertStringContainsString(
            needle  : '<div><img class="aspect-square h-full w-full" x-ref="image" hidden="" src="https://images.unsplash.com/photo-1511485977113-f34c92461ad9" alt="Image alt text" /></div>',
            haystack: preg_replace(['/>\s+</', '/\s+/'], ['><', ' '], $this->minify($this->blade($template))),
        );
    }
}
