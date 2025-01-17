<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverKeys;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group>
                    <x-radio-group-item dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertVisible('@radio')
                ->assertAriaAttribute('@radio', 'checked', 'false')
                ->assertDataAttribute('@radio', 'state', 'unchecked')
                ->assertMissing('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'unchecked');
        });
    }

    #[Test]
    public function it_renders_the_component_as_checked(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group value="item-1">
                    <x-radio-group-item value="item-1" dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertAriaAttribute('@radio', 'checked', 'true')
                ->assertDataAttribute('@radio', 'state', 'checked')
                ->assertVisible('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'checked')
                ->assertVisible('@radio svg');
        });
    }

    #[Test]
    public function it_renders_the_component_as_unchecked(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group value="item-1">
                    <x-radio-group-item value="item-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertAriaAttribute('@radio', 'checked', 'false')
                ->assertDataAttribute('@radio', 'state', 'unchecked')
                ->assertMissing('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@radio svg');
        });
    }

    #[Test]
    public function it_can_be_checked(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group>
                    <x-radio-group-item dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertAriaAttribute('@radio', 'checked', 'false')
                ->assertDataAttribute('@radio', 'state', 'unchecked')
                ->assertMissing('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@radio svg')
                ->click('@radio')
                ->assertAriaAttribute('@radio', 'checked', 'true')
                ->assertDataAttribute('@radio', 'state', 'checked')
                ->assertVisible('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'checked')
                ->assertVisible('@radio svg');
        });
    }

    #[Test]
    public function it_can_be_disabled(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group disabled>
                    <x-radio-group-item dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertDisabled('@radio')
                ->assertAriaAttribute('@radio', 'checked', 'false')
                ->assertDataAttribute('@radio', 'state', 'unchecked')
                ->assertMissing('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@radio svg')
                ->click('@radio')
                ->assertAriaAttribute('@radio', 'checked', 'false')
                ->assertDataAttribute('@radio', 'state', 'unchecked')
                ->assertMissing('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@radio svg');
        });
    }

    #[Test]
    public function it_can_be_required(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group required>
                    <x-radio-group-item dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertAriaAttribute('@radio', 'required', 'true');
        });
    }

    #[Test]
    public function it_can_have_a_custom_value(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group>
                    <x-radio-group-item value="custom" dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertValue('@radio', 'custom');
        });
    }

    #[Test]
    public function it_renders_an_input_if_inside_a_form()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <form>
                    <x-radio-group>
                        <x-radio-group-item id="radio" dusk="radio"></x-radio-group-item>
                    </x-radio-group>
                </form>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertVisible('@radio')
                ->assertInputPresent('radio')
                ->assertAriaAttribute('input#radio', 'hidden', 'true');
        });
    }

    #[Test]
    public function it_propagates_attributes_to_the_hidden_input_if_inside_a_form()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <form>
                    <x-radio-group>
                        <x-radio-group-item id="radio" dusk="radio"></x-radio-group-item>
                    </x-radio-group>
                </form>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->click('@radio')
                ->assertRadioSelected('input#radio', 'on')
                ->assertAttribute('input#radio', 'checked', 'true');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group theme="New York">
                    <x-radio-group-item dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertAttributeDoesntContain('@radio', 'class', 'ring-offset-background focus:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2')
                ->assertAttributeContains('@radio', 'class', 'shadow focus:outline-none focus-visible:ring-1 focus-visible:ring-ring')
                ->assertAttributeDoesntContain('@radio svg', 'class', 'h-2.5 w-2.5')
                ->assertAttributeContains('@radio svg', 'class', 'h-3.5 w-3.5');
        });
    }

    #[Test]
    public function it_focuses_the_checked_radio_item_or_the_first_radio_item_in_the_group_on_tab_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group value="item-2" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@group')
                        ->sendKeys(WebDriverKeys::TAB);
                })
                ->assertFocused('@radio-2');
        });

        $this->closeAll();

        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@group')
                        ->sendKeys(WebDriverKeys::TAB);
                })
                ->assertFocused('@radio-1');
        });
    }

    #[Test]
    public function it_checks_the_radio_item_on_space_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group>
                    <x-radio-group-item dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->assertAriaAttribute('@radio', 'checked', 'false')
                ->assertDataAttribute('@radio', 'state', 'unchecked')
                ->assertMissing('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@radio svg')
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio')
                        ->sendKeys(WebDriverKeys::SPACE);
                })
                ->assertAriaAttribute('@radio', 'checked', 'true')
                ->assertDataAttribute('@radio', 'state', 'checked')
                ->assertVisible('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'checked')
                ->assertVisible('@radio svg');
        });
    }

    #[Test]
    public function it_does_not_check_the_radio_item_on_enter_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group>
                    <x-radio-group-item dusk="radio"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio')
                        ->sendKeys(WebDriverKeys::ENTER);
                })
                ->assertAriaAttribute('@radio', 'checked', 'false')
                ->assertDataAttribute('@radio', 'state', 'unchecked')
                ->assertMissing('@radio [x-ref="indicator"]')
                ->assertDataAttribute('@radio [x-ref="indicator"]', 'state', 'unchecked')
                ->assertMissing('@radio svg');
        });
    }

    #[Test]
    public function it_moves_to_the_next_radio_item_on_arrow_down_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-1')
                        ->sendKeys(WebDriverKeys::ARROW_DOWN);
                })
                ->assertFocused('@radio-2');
        });
    }

    #[Test]
    public function it_loops_to_the_first_radio_item_when_at_the_last_radio_item_and_loop_is_enabled_on_arrow_down_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="true" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-2')
                        ->sendKeys(WebDriverKeys::ARROW_DOWN);
                })
                ->assertFocused('@radio-1');
        });
    }

    #[Test]
    public function it_does_not_loop_to_the_first_radio_item_when_at_the_last_radio_item_and_loop_is_disabled_on_arrow_down_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="false" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-2')
                        ->sendKeys(WebDriverKeys::ARROW_DOWN);
                })
                ->assertFocused('@radio-2');
        });
    }

    #[Test]
    public function it_moves_to_the_next_radio_item_on_arrow_right_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-1')
                        ->sendKeys([
                            WebDriverKeys::ARROW_RIGHT,
                        ]);
                })
                ->assertFocused('@radio-2');
        });
    }

    #[Test]
    public function it_loops_to_the_first_radio_item_when_at_the_last_radio_item_and_loop_is_enabled_on_arrow_right_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="true" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-2')
                        ->sendKeys(WebDriverKeys::ARROW_RIGHT);
                })
                ->assertFocused('@radio-1');
        });
    }

    #[Test]
    public function it_does_not_loop_to_the_first_radio_item_when_at_the_last_radio_item_and_loop_is_disabled_on_arrow_right_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="false" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-2')
                        ->sendKeys(WebDriverKeys::ARROW_RIGHT);
                })
                ->assertFocused('@radio-2');
        });
    }

    #[Test]
    public function it_moves_to_the_previous_radio_item_on_arrow_up_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-2')
                        ->sendKeys(WebDriverKeys::ARROW_UP);
                })
                ->assertFocused('@radio-1');
        });
    }

    #[Test]
    public function it_loops_to_the_last_radio_item_when_at_the_first_radio_item_and_loop_is_enabled_on_arrow_up_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="true" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-1')
                        ->sendKeys(WebDriverKeys::ARROW_UP);
                })
                ->assertFocused('@radio-2');
        });
    }

    #[Test]
    public function it_does_not_loop_to_the_last_radio_item_when_at_the_first_radio_item_and_loop_is_disabled_on_arrow_up_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="false" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-1')
                        ->sendKeys(WebDriverKeys::ARROW_UP);
                })
                ->assertFocused('@radio-1');
        });
    }

    #[Test]
    public function it_moves_to_the_previous_radio_item_on_arrow_left_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-2')
                        ->sendKeys(WebDriverKeys::ARROW_LEFT);
                })
                ->assertFocused('@radio-1');
        });
    }

    #[Test]
    public function it_loops_to_the_last_radio_item_when_at_the_first_radio_item_and_loop_is_enabled_on_arrow_left_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="true" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-1')
                        ->sendKeys(WebDriverKeys::ARROW_LEFT);
                })
                ->assertFocused('@radio-2');
        });
    }

    #[Test]
    public function it_does_not_loop_to_the_last_radio_item_when_at_the_first_radio_item_and_loop_is_disabled_on_arrow_left_key()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group loop="false" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-1')
                        ->sendKeys(WebDriverKeys::ARROW_LEFT);
                })
                ->assertFocused('@radio-1');
        });
    }

    #[Test]
    public function it_checks_the_radio_item_when_navigated_via_the_keyboard()
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@group')
                        ->sendKeys(WebDriverKeys::ARROW_DOWN);
                })
                ->assertAriaAttribute('@radio-1', 'checked', 'true')
                ->assertDataAttribute('@radio-1', 'state', 'checked')
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@radio-1')
                        ->sendKeys(WebDriverKeys::ARROW_DOWN);
                })
                ->assertAriaAttribute('@radio-1', 'checked', 'false')
                ->assertDataAttribute('@radio-1', 'state', 'unchecked')
                ->assertAriaAttribute('@radio-2', 'checked', 'true')
                ->assertDataAttribute('@radio-2', 'state', 'checked');
        });
    }

    #[Test]
    public function it_fires_value_change_event(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-radio-group x-on:value-change="$el.setAttribute('data-value', $event.detail.value)" dusk="group">
                    <x-radio-group-item value="item-1" dusk="radio-1"></x-radio-group-item>
                    <x-radio-group-item value="item-2" dusk="radio-2"></x-radio-group-item>
                </x-radio-group>
            HTML;

            $browser->visit($this->component($template, ['radio-group.js']))
                ->click('@radio-1')
                ->assertDataAttribute('@group', 'value', 'item-1')
                ->click('@radio-2')
                ->assertDataAttribute('@group', 'value', 'item-2');
        });
    }
}