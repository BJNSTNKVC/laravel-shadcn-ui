<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Badge;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class BadgeTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-badge>Default</x-badge>
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
                <x-badge variant="destructive" dusk="destructive">Destructive</x-badge>
                <x-badge variant="outline" dusk="outline">Outline</x-badge>
                <x-badge variant="secondary" dusk="secondary">Secondary</x-badge>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeContains('@destructive', 'class', 'bg-destructive text-destructive-foreground hover:bg-destructive/80')
                ->assertAttributeContains('@outline', 'class', 'text-foreground')
                ->assertAttributeContains('@secondary', 'class', 'border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-badge theme="New York" dusk="badge">Default</x-badge>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeDoesntContain('@badge', 'class', 'rounded-full')
                ->assertAttributeContains('@badge', 'class', 'rounded-md shadow');
        });
    }
}