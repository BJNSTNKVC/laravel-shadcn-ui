<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Button;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class ButtonTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-button>Default</x-button>
            HTML;

            $browser->visit($this->component($template))
                ->assertSee('Default');
        });
    }

    #[Test]
    public function it_can_have_a_variant(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <div class="flex gap-5">
                    <x-button variant="default" dusk="default">Default</x-button>
                    <x-button variant="destructive" dusk="destructive">Destructive</x-button>
                    <x-button variant="outline" dusk="outline">Outline</x-button>
                    <x-button variant="secondary" dusk="secondary">Secondary</x-button>
                    <x-button variant="ghost" dusk="ghost">Ghost</x-button>
                    <x-button variant="link" dusk="link">Link</x-button>
                </div>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeContains('@default', 'class', 'bg-primary text-primary-foreground hover:bg-primary/90')
                ->assertAttributeContains('@destructive', 'class', 'bg-destructive text-destructive-foreground hover:bg-destructive/90')
                ->assertAttributeContains('@outline', 'class', 'border border-input bg-background hover:bg-accent hover:text-accent-foreground')
                ->assertAttributeContains('@secondary', 'class', 'bg-secondary text-secondary-foreground hover:bg-secondary/80')
                ->assertAttributeContains('@ghost', 'class', 'hover:bg-accent hover:text-accent-foreground')
                ->assertAttributeContains('@link', 'class', 'text-primary underline-offset-4 hover:underline');
        });
    }

    #[Test]
    public function it_can_have_a_size(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <div class="flex gap-5">
                    <x-button size="default" dusk="default">Default</x-button>
                    <x-button size="sm" dusk="sm">Small</x-button>
                    <x-button size="lg" dusk="lg">Large</x-button>
                    <x-button size="icon" dusk="icon">Icon</x-button>
                </div>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeContains('@default', 'class', 'h-10 px-4 py-2')
                ->assertAttributeContains('@sm', 'class', 'h-9 rounded-md px-3')
                ->assertAttributeContains('@lg', 'class', 'h-11 rounded-md px-8')
                ->assertAttributeContains('@icon', 'class', 'h-10 w-10');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-button theme="New York" dusk="button">Default</x-button>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeDoesntContain('@button', 'class', 'ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2')
                ->assertAttributeContains('@button', 'class', 'focus-visible:ring-1 shadow h-9');
        });
    }
}