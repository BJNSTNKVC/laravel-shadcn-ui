<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Label;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class LabelTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-label>Email</x-label> 
            HTML;

            $browser->visit($this->component($template))
                ->assertSee('Email');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->markTestSkipped('Component provides only the skeleton.');
    }

    #[Test]
    public function it_retain_native_functionality(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-label for="email" dusk="label">Email</x-label> 
                <input type="text" id="email" dusk="input">
            HTML;

            $browser->visit($this->component($template))
                ->click('@label')
                ->assertFocused('@input');
        });
    }
}