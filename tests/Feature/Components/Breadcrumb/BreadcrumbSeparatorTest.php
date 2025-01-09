<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbSeparatorTest extends TestCase
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
                    <x-breadcrumb-separator></x-breadcrumb-separator>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<li class="[&>svg]:w-3.5 [&>svg]:h-3.5" role="presentation" aria-hidden="true">',
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
                        <x-breadcrumb-link></x-breadcrumb-link>
                    </x-breadcrumb-item>
                    <x-breadcrumb-separator class="bg-red-500"></x-breadcrumb-separator>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringContainsString(
            needle  : '<li class="[&>svg]:w-3.5 [&>svg]:h-3.5 bg-red-500" role="presentation" aria-hidden="true">',
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
                        <x-breadcrumb-link></x-breadcrumb-link>
                    </x-breadcrumb-item>
                    <x-breadcrumb-separator as-child>
                        <section></section>
                    </x-breadcrumb-separator>
                </x-breadcrumb-list>
            </x-breadcrumb>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<li class="[&>svg]:w-3.5 [&>svg]:h-3.5" role="presentation" aria-hidden="true">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="[&>svg]:w-3.5 [&>svg]:h-3.5" role="presentation" aria-hidden="true">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
