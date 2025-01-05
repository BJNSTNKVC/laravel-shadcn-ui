<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Facebook\WebDriver\WebDriverKeys;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class AccordionTest extends DuskTestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger>Trigger</x-accordion-trigger>
                        <x-accordion-content>Content</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertSee('Trigger')
                ->assertDontSee('Content');
        });
    }

    #[Test]
    public function it_expands_the_accordion_item(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content>Content</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertSee('Trigger')
                ->assertDontSee('Content')
                ->click('@item-1')
                ->pause(200)
                ->assertSee('Content');
        });
    }

    #[Test]
    public function it_auto_opens_item_when_type_is_single_and_values_match(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" type="single" value="item-1">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger>Trigger</x-accordion-trigger>
                        <x-accordion-content>Content</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertSee('Content');
        });
    }

    #[Test]
    public function it_auto_opens_multiple_items_when_type_is_multiple_and_values_match(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" type="multiple" :value="['item-1', 'item-2']">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger>Trigger</x-accordion-trigger>
                        <x-accordion-content>Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger>Trigger 2</x-accordion-trigger>
                        <x-accordion-content>Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertSee('Content')
                ->assertSee('Content 2');
        });
    }

    #[Test]
    public function it_collapses_inactive_accordion_item_when_type_is_single(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" type="single">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-2')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'open');
        });
    }

    #[Test]
    public function it_does_not_collapse_inactive_accordion_item_when_type_is_multiple(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" type="multiple">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-2')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'open');
        });
    }

    #[Test]
    public function it_does_not_collapse_inactive_accordion_item_when_not_collapsible(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'closed');
        });
    }

    #[Test]
    public function it_collapses_inactive_accordion_item_when_collapsible(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" collapsible>
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed');
        });
    }

    #[Test]
    public function it_does_not_expand_accordion_items_when_accordion_is_disabled(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" disabled>
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-2')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed');
        });
    }

    #[Test]
    public function it_does_not_expand_accordion_item_when_accordion_item_is_disabled(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2" disabled>
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertAttribute('@content-1', 'data-state', 'closed')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-1')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'closed')
                ->click('@item-2')
                ->pause(200)
                ->assertAttribute('@content-1', 'data-state', 'open')
                ->assertAttribute('@content-2', 'data-state', 'closed');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" theme="New York">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->assertAttributeContains('@content-1', 'class', 'text-sm')
                ->assertAttributeContains('@item-1', 'class', 'text-sm');
        });
    }

    #[Test]
    public function it_moves_to_the_next_accordion_item_on_arrow_down_key(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-1')
                        ->sendKeys(WebDriverKeys::ARROW_DOWN);
                })
                ->assertFocused('@item-2');
        });
    }

    #[Test]
    public function it_moves_to_the_previous_accordion_item_on_arrow_up_key(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-2')
                        ->sendKeys(WebDriverKeys::ARROW_UP);
                })
                ->assertFocused('@item-1');
        });
    }

    #[Test]
    public function it_moves_to_the_next_accordion_item_on_arrow_right_key_when_orientation_is_horizontal(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" orientation="horizontal">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-1')
                        ->sendKeys(WebDriverKeys::ARROW_RIGHT);
                })
                ->assertFocused('@item-2');
        });
    }

    #[Test]
    public function it_moves_to_the_previous_accordion_item_on_arrow_up_key_when_orientation_is_horizontal(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" orientation="horizontal">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-2')
                        ->sendKeys(WebDriverKeys::ARROW_LEFT);
                })
                ->assertFocused('@item-1');
        });
    }

    #[Test]
    public function it_moves_to_the_next_accordion_item_on_arrow_left_key_when_orientation_is_horizontal_and_direction_is_ltr(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" orientation="horizontal" direction="ltr">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-2')
                        ->sendKeys(WebDriverKeys::ARROW_LEFT);
                })
                ->assertFocused('@item-1');
        });
    }

    #[Test]
    public function it_moves_to_the_previous_accordion_item_on_arrow_right_key_when_orientation_is_horizontal_and_direction_is_ltr(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" orientation="horizontal" direction="ltr">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-1')
                        ->sendKeys(WebDriverKeys::ARROW_RIGHT);
                })
                ->assertFocused('@item-2');
        });
    }

    #[Test]
    public function it_moves_to_the_first_accordion_item_on_home_key(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-2')
                        ->sendKeys(WebDriverKeys::HOME);
                })
                ->assertFocused('@item-1');
        });
    }

    #[Test]
    public function it_moves_to_the_last_accordion_item_on_end_key(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-1')
                        ->sendKeys(WebDriverKeys::END);
                })
                ->assertFocused('@item-2');
        });
    }

    #[Test]
    public function it_expands_accordion_item_on_space_key(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-1')
                        ->sendKeys(WebDriverKeys::SPACE);
                })
                ->assertAttribute('@content-1', 'data-state', 'open');
        });
    }

    #[Test]
    public function it_expands_accordion_item_on_enter_key(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@item-1')
                        ->sendKeys(WebDriverKeys::ENTER);
                })
                ->assertAttribute('@content-1', 'data-state', 'open');
        });
    }

    #[Test]
    public function it_fires_value_change_event_when_type_is_single(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" type="single" x-on:value-change="$el.setAttribute('data-active', $event.detail.value)">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->click('@item-1')
                ->assertAttribute('div', 'data-active', 'item-1')
                ->click('@item-2')
                ->assertAttribute('div', 'data-active', 'item-2');
        });
    }

    #[Test]
    public function it_fires_value_change_event_when_type_is_multiple(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-accordion class="w-full" type="multiple" x-on:value-change="$el.setAttribute('data-active', $event.detail.value)">
                    <x-accordion-item value="item-1">
                        <x-accordion-trigger dusk="item-1">Trigger</x-accordion-trigger>
                        <x-accordion-content dusk="content-1">Content</x-accordion-content>
                    </x-accordion-item>
                    <x-accordion-item value="item-2">
                        <x-accordion-trigger dusk="item-2">Trigger 2</x-accordion-trigger>
                        <x-accordion-content dusk="content-2">Content 2</x-accordion-content>
                    </x-accordion-item>
                </x-accordion>
            HTML;

            $browser->visit($this->component($component, ['accordion.js']))
                ->click('@item-1')
                ->click('@item-2')
                ->assertAttribute('div', 'data-active', 'item-1,item-2');
        });
    }
}