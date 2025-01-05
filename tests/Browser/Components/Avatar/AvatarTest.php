<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Avatar;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class AvatarTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-avatar>
                    <x-avatar-image src="https://github.com/shadcn.png" dusk="image" />
                    <x-avatar-fallback dusk="fallback">CN</x-avatar-fallback>
                </x-avatar>
            HTML;

            $browser->visit($this->component($component))
                ->assertAttribute('@image', 'x-ref', 'image')
                ->assertAttribute('@fallback', 'x-ref', 'fallback');
        });
    }

    #[Test]
    public function it_shows_the_fallback_when_image_is_not_loaded(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-avatar>
                    <x-avatar-image src="https://github.com/non-existing-image.png" dusk="image" />
                    <x-avatar-fallback dusk="fallback">CN</x-avatar-fallback>
                </x-avatar>
            HTML;

            $browser->visit($this->component($component, ['avatar.js']))
                ->assertAttributeContains('@image', 'hidden', 'true')
                ->assertVisible('@fallback');
        });
    }

    #[Test]
    public function it_shows_the_fallback_while_image_is_loading(): void
    {
        $this->markTestSkipped('Unable to test due to https://github.com/laravel/framework/discussions/53856');
    }

    #[Test]
    public function it_delays_the_fallback_when_image_is_not_loaded(): void
    {
        $this->closeAll();

        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-avatar>
                    <x-avatar-image src="non-existing-image.png" dusk="image" />
                    <x-avatar-fallback delay="1000" dusk="fallback">CN</x-avatar-fallback>
                </x-avatar>
            HTML;

            $browser->visit($this->component($component, ['avatar.js']))
                ->assertAttribute('@image', 'hidden', 'true')
                ->assertMissing('@fallback')
                ->pause(1000)
                ->assertVisible('@fallback');
        });
    }

    #[Test]
    public function it_removes_the_fallback_when_image_is_loaded(): void
    {
        $this->browse(function (Browser $browser) {
            $component = <<<'HTML'
                <x-avatar>
                    <x-avatar-image src="https://github.com/shadcn.png" dusk="image" />
                    <x-avatar-fallback dusk="fallback">CN</x-avatar-fallback>
                </x-avatar>
            HTML;

            $browser->visit($this->component($component, ['avatar.js']))
                ->whenAvailable('@image', function (Browser $browser) {
                    $browser->assertMissing('@fallback');
                });
        });
    }

    #[Test]
    public function it_fires_loading_status_change_event(): void
    {
        $this->closeAll();

        $script = <<<'JS'
            if ($el.hasAttribute('data-status')) {
                $el.setAttribute('data-status', $el.getAttribute('data-status') + ',' + $event.detail.status)
            } else {
                $el.setAttribute('data-status', $event.detail.status)
            }
        JS;

        $this->browse(function (Browser $browser) use ($script) {
            $component = <<<"HTML"
                <x-avatar dusk="avatar">
                    <x-avatar-image src="https://s1.1zoom.me/big3/698/Planets_Surface_of_496688.jpg" dusk="image" x-on:loading-status-change="$script" />
                    <x-avatar-fallback dusk="fallback">CN</x-avatar-fallback>
                </x-avatar>
            HTML;

            $browser->visit($this->component($component, ['avatar.js']))
                ->assertAttribute('@image', 'data-status', 'idle,loading,loaded');
        });

        $this->closeAll();

        $this->browse(function (Browser $browser) use ($script) {
            $component = <<<"HTML"
                <x-avatar dusk="avatar">
                    <x-avatar-image src="non-existing-image.png" dusk="image" x-on:loading-status-change="$script" />
                    <x-avatar-fallback dusk="fallback">CN</x-avatar-fallback>
                </x-avatar>
            HTML;

            $browser->visit($this->component($component, ['avatar.js']))
                ->assertAttribute('@image', 'data-status', 'idle,loading,error');
        });
    }
}