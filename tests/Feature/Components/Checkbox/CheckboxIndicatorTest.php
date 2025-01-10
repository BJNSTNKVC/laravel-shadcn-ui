<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Checkbox;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CheckboxIndicatorTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-checkbox as-child>
                <button>
                    <x-checkbox-indicator></x-checkbox-indicator>
                </button>
            </x-checkbox>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="flex items-center justify-center text-current hidden" style="pointer-events;" data-state="indeterminate" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-checkbox checked as-child>
                <button>
                    <x-checkbox-indicator class="text-blue-600"></x-checkbox-indicator>
                </button>
            </x-checkbox>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="flex items-center justify-center text-current text-blue-600" style="pointer-events;" data-state="checked" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-checkbox as-child>
                <button>
                    <x-checkbox-indicator>
                        <div>Hello World</div>
                    </x-checkbox-indicator>
                </button>
            </x-checkbox>
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
            <x-checkbox as-child>
                <button>
                    <x-checkbox-indicator as-child>
                        <section></section>
                    </x-checkbox-indicator>
                </button>
            </x-checkbox>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<span class="flex items-center justify-center text-current hidden" style="pointer-events;" data-state="indeterminate" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="flex items-center justify-center text-current hidden" style="pointer-events;" data-state="indeterminate" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
