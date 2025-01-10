<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class CardTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-card class="w-96">
                    <x-card-header>
                        <x-card-title>Title</x-card-title>
                        <x-card-description>Description</x-card-description>
                    </x-card-header>
                    <x-card-content>
                        <p>Content</p>
                    </x-card-content>
                    <x-card-footer>
                        <p>Footer</p>
                    </x-card-footer>
                </x-card>
            HTML;

            $browser->visit($this->component($template))
                ->assertSee('Title')
                ->assertSee('Description')
                ->assertSee('Content')
                ->assertSee('Footer');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-card class="w-96" theme="New York" dusk="card">
                    <x-card-header>
                        <x-card-title dusk="title">Title</x-card-title>
                        <x-card-description>Description</x-card-description>
                    </x-card-header>
                    <x-card-content>
                        <p>Content</p>
                    </x-card-content>
                    <x-card-footer>
                        <p>Footer</p>
                    </x-card-footer>
                </x-card>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeDoesntContain('@card', 'class', 'rounded-lg shadow-sm')
                ->assertAttributeContains('@card', 'class', 'rounded-xl shadow')
                ->assertAttributeDoesntContain('@title', 'class', 'text-2xl');
        });
    }
}