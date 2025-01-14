<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Input;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class InputTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-input type="email" name="email" placeholder="Email"  /> 
            HTML;

            $browser->visit($this->component($template))
                ->assertInputPresent('email');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-input type="email" placeholder="Email" theme="New York" dusk="input" /> 
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeDoesntContain('@input', 'class', 'h-10 bg-background py-2 ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2')
                ->assertAttributeContains('@input', 'class', 'h-9 bg-transparent py-1 shadow-sm transition-colors focus-visible:ring-1');
        });
    }
}