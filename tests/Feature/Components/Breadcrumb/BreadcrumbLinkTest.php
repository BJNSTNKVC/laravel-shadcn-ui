<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbLinkTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-breadcrumb>
                <x-breadcrumb-list>
                     <x-breadcrumb-item>
                        <x-breadcrumb-link></x-breadcrumb-link>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<a class="transition-colors hover:text-accent-foreground">',
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
                        <x-breadcrumb-link href="/"></x-breadcrumb-link>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<a class="transition-colors hover:text-accent-foreground" href="/">',
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
                        <x-breadcrumb-link>
                            <div>Hello World</div>
                        </x-breadcrumb-link>
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
                    <x-breadcrumb-item>
                        <x-breadcrumb-link as-child>
                            <section></section>
                        </x-breadcrumb-link>
                    </x-breadcrumb-item>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<a class="transition-colors hover:text-accent-foreground">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="transition-colors hover:text-accent-foreground">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
