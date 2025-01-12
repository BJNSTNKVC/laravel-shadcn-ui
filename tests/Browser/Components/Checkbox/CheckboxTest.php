<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Checkbox;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverKeys;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class CheckboxTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertVisible('@checkbox')
                ->assertAriaAttribute('@checkbox', 'checked', 'false')
                ->assertDataAttribute('@checkbox', 'state', 'indeterminate')
                ->assertMissing('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'indeterminate');
        });
    }

    #[Test]
    public function it_renders_the_component_as_checked(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox  checked dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertAriaAttribute('@checkbox', 'checked', 'true')
                ->assertDataAttribute('@checkbox', 'state', 'checked')
                ->assertVisible('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'checked')
                ->assertVisible('@checkbox svg');
        });
    }

    #[Test]
    public function it_renders_the_component_as_unchecked(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox checked="false" dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertAriaAttribute('@checkbox', 'checked', 'false')
                ->assertDataAttribute('@checkbox', 'state', 'unchecked')
                ->assertMissing('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@checkbox svg');
        });
    }

    #[Test]
    public function it_can_be_toggled(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->click('@checkbox')
                ->assertAriaAttribute('@checkbox', 'checked', 'true')
                ->assertDataAttribute('@checkbox', 'state', 'checked')
                ->assertVisible('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'checked')
                ->assertVisible('@checkbox svg')
                ->click('@checkbox')
                ->assertAriaAttribute('@checkbox', 'checked', 'false')
                ->assertDataAttribute('@checkbox', 'state', 'unchecked')
                ->assertMissing('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@checkbox svg');
        });
    }

    #[Test]
    public function it_can_be_disabled(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox disabled dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertDisabled('@checkbox')
                ->assertAriaAttribute('@checkbox', 'checked', 'false')
                ->assertDataAttribute('@checkbox', 'state', 'indeterminate')
                ->assertMissing('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'indeterminate')
                ->assertMissing('@checkbox svg')
                ->click('@checkbox')
                ->assertAriaAttribute('@checkbox', 'checked', 'false')
                ->assertDataAttribute('@checkbox', 'state', 'indeterminate')
                ->assertMissing('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'indeterminate')
                ->assertMissing('@checkbox svg');
        });
    }

    #[Test]
    public function it_can_be_required(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox required dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertAriaAttribute('@checkbox', 'required', 'true');
        });
    }

    #[Test]
    public function it_can_have_a_custom_value(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox value="custom" dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertValue('@checkbox', 'custom');
        });
    }

    #[Test]
    public function it_renders_an_input_if_inside_a_form()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <form>
                    <x-checkbox id="checkbox" dusk="checkbox"></x-checkbox>
                </form>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertVisible('@checkbox')
                ->assertInputPresent('checkbox')
                ->assertAriaAttribute('input#checkbox', 'hidden', 'true');
        });
    }

    #[Test]
    public function it_propagates_attributes_to_the_hidden_input_if_inside_a_form()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <form>
                    <x-checkbox id="checkbox" dusk="checkbox"></x-checkbox>
                </form>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->click('@checkbox')
                ->assertChecked('checkbox', 'on')
                ->assertAttribute('input#checkbox', 'checked', 'true');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox theme="New York" dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->assertAttributeDoesntContain('@checkbox', 'class', 'ring-offset-background focus-visible:ring-2 focus-visible:ring-offset-2')
                ->assertAttributeContains('@checkbox', 'class', 'shadow focus-visible:ring-1');
        });
    }

    #[Test]
    public function it_toggles_the_checkbox_on_space_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@checkbox')
                        ->sendKeys(WebDriverKeys::SPACE);
                })
                ->assertAriaAttribute('@checkbox', 'checked', 'true')
                ->assertDataAttribute('@checkbox', 'state', 'checked')
                ->assertVisible('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'checked')
                ->assertVisible('@checkbox svg')
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@checkbox')
                        ->sendKeys(WebDriverKeys::SPACE);
                })
                ->assertAriaAttribute('@checkbox', 'checked', 'false')
                ->assertDataAttribute('@checkbox', 'state', 'unchecked')
                ->assertMissing('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@checkbox svg');
        });
    }

    #[Test]
    public function it_does_not_toggle_the_checkbox_on_enter_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@checkbox')
                        ->sendKeys(WebDriverKeys::ENTER);
                })
                ->assertAriaAttribute('@checkbox', 'checked', 'false')
                ->assertDataAttribute('@checkbox', 'state', 'indeterminate')
                ->assertMissing('@checkbox [x-ref="indicator"]')
                ->assertDataAttribute('@checkbox [x-ref="indicator"]', 'state', 'indeterminate')
                ->assertMissing('@checkbox svg');
        });
    }

    #[Test]
    public function it_fires_check_change_event(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-checkbox x-on:check-change="$el.setAttribute('data-checked', $event.detail.checked)" dusk="checkbox"></x-checkbox>
            HTML;

            $browser->visit($this->component($template, ['checkbox.js']))
                ->click('@checkbox')
                ->assertDataAttribute('@checkbox', 'checked', 'true')
                ->click('@checkbox')
                ->assertDataAttribute('@checkbox', 'checked', 'false');
        });
    }
}