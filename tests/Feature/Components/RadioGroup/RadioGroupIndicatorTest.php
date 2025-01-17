<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupIndicatorTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-radio-group>
                <x-radio-group-item as-child>
                    <button>
                        <x-radio-group-indicator></x-radio-group-indicator>
                    </button>
                </x-radio-group-item>
            </x-radio-group>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="h-full flex items-center justify-center hidden" style="pointer-events;" data-state="unchecked" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-radio-group value="item-1">
                <x-radio-group-item value="item-1" as-child>
                    <button>
                        <x-radio-group-indicator class="text-blue-600"></x-radio-group-indicator>
                    </button>
                </x-radio-group-item>
            </x-radio-group>
        HTML;

        $this->assertStringContainsString(
            needle  : '<span class="h-full flex items-center justify-center text-blue-600" style="pointer-events;" data-state="checked" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_slot()
    {
        $template = <<<'HTML'
            <x-radio-group>
                <x-radio-group-item as-child>
                    <button>
                        <x-radio-group-indicator>
                            <div>Hello World</div>
                        </x-radio-group-indicator>
                    </button>
                </x-radio-group-item>
            </x-radio-group>
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
            <x-radio-group>
                <x-radio-group-item as-child>
                    <button>
                        <x-radio-group-indicator as-child>
                            <section></section>
                        </x-radio-group-indicator>
                    </button>
                </x-radio-group-item>
            </x-radio-group>
        HTML;

        $this->assertStringNotContainsString(
            needle  : '<span class="h-full flex items-center justify-center hidden" style="pointer-events;" data-state="unchecked" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );

        $this->assertStringContainsString(
            needle  : '<section class="h-full flex items-center justify-center hidden" style="pointer-events;" data-state="unchecked" x-ref="indicator">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
