<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\Carousel;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselItem;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselNext;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselPrevious;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CarouselItemTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $carousel = $this->component(class: Carousel::class);
        $item     = $this->component(class: CarouselItem::class);

        $components = [
            'Carousel Next'     => $this->component(class: CarouselNext::class),
            'Carousel Previous' => $this->component(class: CarouselPrevious::class),
        ];

        foreach ($components as $name => $component) {
            $this->assertTrue(
                condition: $component->index === CarouselItem::$index,
                message  : "The data is not shared correctly for $name component."
            );
        }
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $item = new CarouselItem(asChild: true);

        $this->assertTrue(
            condition: $item->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $item = new CarouselItem(asChild: false);

        $this->assertFalse(
            condition: $item->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $item = new CarouselItem();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $item->render(),
            message : 'The Carousel Item component is not rendered correctly.'
        );
    }
}
