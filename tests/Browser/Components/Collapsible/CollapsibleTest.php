<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Facebook\WebDriver\WebDriverKeys;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class CollapsibleTest extends DuskTestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-collapsible class="w-full">
                    <x-collapsible-trigger dusk="trigger">Trigger</x-collapsible-trigger>
                    <x-collapsible-content dusk="trigger">Content</x-collapsible-content>
                </x-collapsible>
            HTML;

            $browser->visit($this->component($template, ['collapsible.js']))
                ->assertSee('Trigger')
                ->assertDontSee('Content');
        });
    }

    #[Test]
    public function it_toggles_the_collapsible_content(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-collapsible class="w-full">
                    <x-collapsible-trigger dusk="trigger">Trigger</x-collapsible-trigger>
                    <x-collapsible-content dusk="content">Content</x-collapsible-content>
                </x-collapsible>
            HTML;

            $browser->visit($this->component($template, ['collapsible.js']))
                ->assertSee('Trigger')
                ->assertDontSee('Content')
                ->click('@trigger')
                ->assertSee('Content')
                ->click('@trigger')
                ->assertDontSee('Content');
        });
    }

    #[Test]
    public function it_auto_opens_the_collapsible_content_when_open_is_true(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-collapsible class="w-full" open>
                    <x-collapsible-trigger dusk="trigger">Trigger</x-collapsible-trigger>
                    <x-collapsible-content dusk="content">Content</x-collapsible-content>
                </x-collapsible>
            HTML;

            $browser->visit($this->component($template, ['collapsible.js']))
                ->assertSee('Content');
        });
    }

    #[Test]
    public function it_does_not_toggle_collapsible_content_when_collapsible_is_disabled(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-collapsible class="w-full" disabled>
                    <x-collapsible-trigger dusk="trigger">Trigger</x-collapsible-trigger>
                    <x-collapsible-content dusk="content">Content</x-collapsible-content>
                </x-collapsible>
            HTML;

            $browser->visit($this->component($template, ['collapsible.js']))
                ->assertDontSee('Content')
                ->click('@trigger')
                ->assertDontSee('Content');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->markTestSkipped('Component provides only the skeleton.');
    }

    #[Test]
    public function it_toggles_collapsible_content_on_space_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-collapsible class="w-full">
                    <x-collapsible-trigger dusk="trigger">Trigger</x-collapsible-trigger>
                    <x-collapsible-content dusk="content">Content</x-collapsible-content>
                </x-collapsible>
            HTML;

            $browser->visit($this->component($template, ['collapsible.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@trigger')
                        ->sendKeys(WebDriverKeys::SPACE);
                })
                ->assertSee('Content')
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@trigger')
                        ->sendKeys(WebDriverKeys::SPACE);
                })
                ->assertDontSee('Content');
        });
    }

    #[Test]
    public function it_toggles_collapsible_content_on_enter_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-collapsible class="w-full">
                    <x-collapsible-trigger dusk="trigger">Trigger</x-collapsible-trigger>
                    <x-collapsible-content dusk="content">Content</x-collapsible-content>
                </x-collapsible>
            HTML;

            $browser->visit($this->component($template, ['collapsible.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@trigger')
                        ->sendKeys(WebDriverKeys::ENTER);
                })
                ->assertSee('Content')
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@trigger')
                        ->sendKeys(WebDriverKeys::ENTER);
                })
                ->assertDontSee('Content');
        });
    }

    #[Test]
    public function it_fires_open_change_event_when_type_is_single(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-collapsible class="w-full" dusk="collapsible" x-on:open-change="$el.setAttribute('data-open', $event.detail.open)">
                    <x-collapsible-trigger dusk="trigger">Trigger</x-collapsible-trigger>
                    <x-collapsible-content dusk="content">Content</x-collapsible-content>
                </x-collapsible>
            HTML;

            $browser->visit($this->component($template, ['collapsible.js']))
                ->click('@trigger')
                ->assertAttribute('@collapsible', 'data-open', 'true')
                ->click('@trigger')
                ->assertAttribute('@collapsible', 'data-open', 'false');
        });
    }
}