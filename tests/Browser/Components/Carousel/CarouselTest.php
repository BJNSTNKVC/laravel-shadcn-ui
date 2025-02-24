<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Facebook\WebDriver\WebDriverKeys;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class CarouselTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-carousel class="w-full max-w-xs">
                    <x-carousel-content>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous />
                    <x-carousel-next />
                </x-carousel>
            HTML;

            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->assertSee(1)
                ->assertDontSee(2);
        });
    }

    #[Test]
    public function it_changes_to_the_next_carousel_item(): void
    {
        $template = <<<'HTML'
                <x-carousel class="w-full max-w-xs">
                    <x-carousel-content>
                        <x-carousel-item dusk="item-1">
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item dusk="item-2">
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous dusk="previous" />
                    <x-carousel-next dusk="next" />
                </x-carousel>
            HTML;

        $this->browse(function (Browser $browser) use ($template) {
            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->click('@next')
                ->pause(500)
                ->assertDontSee(1)
                ->assertSee(2);
        });

        $this->browse(function (Browser $browser) use ($template) {
            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->clickAndHold('@item-1')
                ->dragLeft('@item-1', 500)
                ->pause(1000)
                ->assertDontSee(1)
                ->assertSee(2);
        });
    }

    #[Test]
    public function it_changes_to_the_previous_carousel_item(): void
    {
        $template = <<<'HTML'
                <x-carousel class="w-full max-w-xs">
                    <x-carousel-content>
                        <x-carousel-item dusk="item-1">
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item dusk="item-2">
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous dusk="previous" />
                    <x-carousel-next dusk="next" />
                </x-carousel>
            HTML;

        $this->browse(function (Browser $browser) use ($template) {
            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->click('@next')
                ->pause(500)
                ->assertDontSee(1)
                ->assertSee(2)
                ->click('@previous')
                ->pause(500)
                ->assertSee(1)
                ->assertDontSee(2);
        });

        $this->browse(function (Browser $browser) use ($template) {
            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->dragLeft('@item-1', 500)
                ->assertDontSee(1)
                ->assertSee(2)
                ->pause(1000)
                ->clickAndHold('@item-2')
                ->dragRight('@item-2', 500)
                ->pause(1000)
                ->assertSee(1)
                ->assertDontSee(2);
        });
    }

    #[Test]
    public function it_can_pass_options(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-carousel class="w-full max-w-xs" :options="['loop' => true, 'startIndex' => 1]">
                    <x-carousel-content>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous dusk="previous" />
                    <x-carousel-next dusk="next" />
                </x-carousel>
            HTML;

            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->assertDontSee(1)
                ->assertSee(2)
                ->click('@previous')
                ->pause(500)
                ->assertSee(1)
                ->assertDontSee(2)
                ->click('@previous')
                ->pause(500)
                ->assertSee(2)
                ->assertDontSee(1);
        });
    }

    #[Test]
    public function it_can_pass_plugins(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-carousel class="w-full max-w-xs" :plugins="['autoplay' => ['delay' => 3000]]">
                    <x-carousel-content>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous dusk="previous" />
                    <x-carousel-next dusk="next" />
                </x-carousel>
            HTML;

            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->assertSee(1)
                ->assertDontSee(2)
                ->pause(3500)
                ->assertDontSee(1)
                ->assertSee(2);
        });
    }

    #[Test]
    public function it_can_pass_props_and_custom_behavior(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-carousel 
                    class="w-full max-w-xs"
                    x-init="
                        count = $api.scrollSnapList().length;
                        $props.current = $api.selectedScrollSnap() + 1;
                        $api.on('select', () => { $props.current = $api.selectedScrollSnap() + 1 })
                    "
                >
                    <x-carousel-content>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous dusk="previous" />
                    <x-carousel-next dusk="next" />

                    <div class="py-2 text-center text-sm text-muted-foreground" x-text="`Slide ${$props.current} of ${count}`" dusk="props" />
                </x-carousel>
            HTML;

            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->assertSeeIn('@props', 'Slide 1 of 2')
                ->click('@next')
                ->pause(500)
                ->assertDontSee(1)
                ->assertSee(2)
                ->assertSeeIn('@props', 'Slide 2 of 2');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->markTestSkipped('Component provides only the skeleton.');
    }

    #[Test]
    public function it_moves_to_the_next_carousel_item_on_arrow_right_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-carousel class="w-full max-w-xs">
                    <x-carousel-content>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous dusk="previous" />
                    <x-carousel-next dusk="next" />
                </x-carousel>
            HTML;

            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@next')
                        ->sendKeys(WebDriverKeys::ARROW_RIGHT);
                })
                ->pause(500)
                ->assertDontSee(1)
                ->assertSee(2);
        });
    }

    #[Test]
    public function it_moves_to_the_previous_carousel_item_on_arrow_left_key(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-carousel class="w-full max-w-xs">
                    <x-carousel-content>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">1</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                        <x-carousel-item>
                            <div class="p-1">
                                <div class="rounded-xl border bg-card text-card-foreground shadow">
                                    <div class="flex aspect-square items-center justify-center p-6">
                                        <span class="text-4xl font-semibold">2</span>
                                    </div>
                                </div>
                            </div>
                        </x-carousel-item>
                    </x-carousel-content>
                    <x-carousel-previous dusk="previous" />
                    <x-carousel-next dusk="next" />
                </x-carousel>
            HTML;

            $browser
                ->visit(
                    $this->component(
                        component: $template,
                        scripts  : ['carousel.js'],
                        cdn      : [
                            'https://unpkg.com/embla-carousel/embla-carousel.umd.js',
                            'https://unpkg.com/embla-carousel-autoplay/embla-carousel-autoplay.umd.js',
                        ]
                    )
                )
                ->click('@next')
                ->pause(500)
                ->tap(function (Browser $browser) {
                    $browser
                        ->element('@previous')
                        ->sendKeys(WebDriverKeys::ARROW_LEFT);
                })
                ->pause(500)
                ->assertSee(1)
                ->assertDontSee(2);
        });
    }
}