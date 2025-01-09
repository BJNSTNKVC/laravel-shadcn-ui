<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbItemTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                     <x-breadcrumb-item></x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<li class="inline-flex items-center gap-1.5">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                     <x-breadcrumb-item class="bg-red-500"></x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<li class="inline-flex items-center gap-1.5 bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                    <x-breadcrumb-item>
                        <div>Hello World</div>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
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
            <x-breadcrumb>
                <x-breadcrumb-list>
                    <x-breadcrumb-item as-child>
                        <section></section>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<li class="inline-flex items-center gap-1.5">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="inline-flex items-center gap-1.5">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
