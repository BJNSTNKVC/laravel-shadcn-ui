<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Alert;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class AlertTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-alert>
                    <x-alert-title>
                        Title
                    </x-alert-title>
                    <x-alert-description>
                        Description.
                    </x-alert-description>
                </x-alert>
            HTML;

            $browser->visit($this->component($component))
                ->assertSee('Title')
                ->assertSee('Description');
        });
    }

    #[Test]
    public function it_can_have_a_variant(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-alert variant="destructive" dusk="alert">
                    <x-alert-title>
                        Title
                    </x-alert-title>
                    <x-alert-description>
                        Description.
                    </x-alert-description>
                </x-alert>
            HTML;

            $browser->visit($this->component($component))
                ->assertAttributeContains('@alert', 'class', 'border-destructive/50 text-destructive [&>svg]:text-destructive');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-alert theme="New York" dusk="alert">
                    <x-alert-title>
                        Title
                    </x-alert-title>
                    <x-alert-description>
                        Description.
                    </x-alert-description>
                </x-alert>
            HTML;

            $browser->visit($this->component($component))
                ->assertAttributeDoesntContain('@alert', 'class', ' p-4')
                ->assertAttributeContains('@alert', 'class', 'px-4 py-3 text-sm');
        });
    }
}