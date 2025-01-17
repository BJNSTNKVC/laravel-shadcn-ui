<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\AspectRatio;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class AspectRatioTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-aspect-ratio dusk="ratio">
                    <img class="size-full object-cover" alt="A placeholder image" src="https://images.unsplash.com/photo-1535025183041-0991a977e25b" />
                </x-aspect-ratio>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttribute('@ratio', 'aspect-ratio-wrapper', '')
                ->assertAttribute('@ratio div', 'style', 'position: absolute; height: 100%; width: 100%; inset: 0px; color: transparent;')
                ->assertAttribute('@ratio img', 'src', 'https://images.unsplash.com/photo-1535025183041-0991a977e25b');
        });
    }

    #[Test]
    public function it_renders_the_component_with_correct_ratio(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-aspect-ratio :ratio="16 / 9">
                    <img class="size-full object-cover" alt="A placeholder image" src="https://images.unsplash.com/photo-1535025183041-0991a977e25b">
                </x-aspect-ratio>
            HTML;

            $browser->visit($this->component($template));

            $width  = $browser->script('return document.querySelector("[aspect-ratio-wrapper]").clientWidth')[0];
            $height = $browser->script('return document.querySelector("[aspect-ratio-wrapper]").clientHeight')[0];

            $this->assertTrue(
                condition: $width / $height === 16 / 9,
                message  : 'The aspect ratio is not correct.'
            );
        });
    }
}