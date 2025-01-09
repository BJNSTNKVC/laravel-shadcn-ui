<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbListTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list></x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<ol class="flex flex-wrap items-center gap-1.5 break-words text-muted-foreground sm:gap-2.5">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list class="bg-red-500"></x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<ol class="flex flex-wrap items-center gap-1.5 break-words text-muted-foreground sm:gap-2.5 bg-red-500">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                    <div>Hello World</div>
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
                <x-breadcrumb-list as-child>
                    <section></section>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<ol class="flex flex-wrap items-center gap-1.5 break-words text-muted-foreground sm:gap-2.5">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="flex flex-wrap items-center gap-1.5 break-words text-muted-foreground sm:gap-2.5">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
