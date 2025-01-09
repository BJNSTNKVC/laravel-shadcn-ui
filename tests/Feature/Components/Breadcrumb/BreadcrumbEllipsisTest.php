<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbEllipsisTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                     <x-breadcrumb-item>
                        <x-breadcrumb-ellipsis></x-breadcrumb-ellipsis>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="flex h-9 w-9 items-center justify-center" role="presentation" aria-hidden="true">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                     <x-breadcrumb-item>
                        <x-breadcrumb-ellipsis class="bg-red-500"></x-breadcrumb-ellipsis>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="flex h-9 w-9 items-center justify-center bg-red-500" role="presentation" aria-hidden="true">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_does_not_render_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                    <x-breadcrumb-item>
                        <x-breadcrumb-ellipsis>
                            <div>Hello World</div>
                        </x-breadcrumb-ellipsis>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
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
            <x-breadcrumb>
                <x-breadcrumb-list>
                    <x-breadcrumb-item>
                        <x-breadcrumb-ellipsis as-child>
                            <section></section>
                        </x-breadcrumb-ellipsis>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<span class="flex h-9 w-9 items-center justify-center" role="presentation" aria-hidden="true">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="flex h-9 w-9 items-center justify-center" role="presentation" aria-hidden="true">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
