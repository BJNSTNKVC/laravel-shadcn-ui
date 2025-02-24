<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\Carousel;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselContent;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselItem;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselNext;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselPrevious;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CarouselTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $carousel = new Carousel(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $carousel->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_orientation_property()
    {
        $carousel = new Carousel(orientation: 'vertical');

        $this->assertEquals(
            expected: 'vertical',
            actual  : $carousel->orientation,
            message : 'The "orientation" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_options_property()
    {
        $carousel = new Carousel(options: ['loop' => true]);

        $this->assertTrue(
            condition: in_array(['loop' => true], $carousel->options),
            message  : 'The "options" property is not set correctly.'
        );
    }

    #[Test]
    public function it_merges_orientation_and_the_options_property()
    {
        $carousel = new Carousel(orientation: 'vertical', options: ['loop' => true]);

        $this->assertEquals(
            expected: ['loop' => true, 'orientation' => 'vertical'],
            actual  : $carousel->options,
            message : 'The "options" property is not merged correctly.'
        );
    }

    #[Test]
    public function it_sets_the_plugins_property()
    {
        $carousel = new Carousel(
            plugins: $plugins = [
                'autoplay' => [
                    'delay'             => 3000,
                    'stopOnMouseEnter'  => true,
                    'stopOnInteraction' => false,
                ],
            ]
        );

        $this->assertEquals(
            expected: $plugins,
            actual  : $carousel->plugins,
            message : 'The "options" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $carousel = new Carousel(asChild: true);

        $this->assertTrue(
            condition: $carousel->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $carousel = new Carousel(asChild: false);

        $this->assertFalse(
            condition: $carousel->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $carousel = $this->component(class: Carousel::class, data: ['theme' => 'New York']);

        $components = [
            'Carousel Content'  => $this->component(class: CarouselContent::class),
            'Carousel Item'     => $this->component(class: CarouselItem::class),
            'Carousel Next'     => $this->component(class: CarouselNext::class),
            'Carousel Previous' => $this->component(class: CarouselPrevious::class),
        ];

        foreach ($components as $name => $component) {
            $this->assertTrue(
                condition: $component->theme === $carousel->theme,
                message  : "The data is not shared correctly for $name component."
            );
        }
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $carousel = new Carousel();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $carousel->render(),
            message : 'The Carousel component is not rendered correctly.'
        );
    }
}
