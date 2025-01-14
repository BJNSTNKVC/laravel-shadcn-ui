<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Feature\Components\Input;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class InputTest extends TestCase
{
    #[Test]
    public function it_renders_the_component()
    {
        $template = <<<'HTML'
            <x-input></x-input>
        HTML;

        $this->assertStringContainsString(
            needle  : '<input class="flex w-full rounded-md border border-input px-3 text-base file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm h-10 bg-background py-2 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2">',
            haystack: $this->minify($this->blade($template)),
        );
    }

    #[Test]
    public function it_renders_the_component_with_props()
    {
        $template = <<<'HTML'
            <x-input type="email" placeholder="Email" /> 
        HTML;

        $this->assertStringContainsString(
            needle  : '<input class="flex w-full rounded-md border border-input px-3 text-base file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 md:text-sm h-10 bg-background py-2 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2" type="email" placeholder="Email">',
            haystack: $this->minify($this->blade($template)),
        );
    }
}
