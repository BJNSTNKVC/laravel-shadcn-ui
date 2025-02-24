<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselPrevious;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CarouselPreviousTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_disabled_property()
    {
        $prev = new CarouselPrevious();

        $disabled = (fn() => $this->disabled(['loop' => false]))->call($prev);

        $this->assertTrue(
            condition: $disabled,
            message  : 'The "disabled" property is not set correctly.'
        );

        $disabled = (fn() => $this->disabled(['loop' => true]))->call($prev);

        $this->assertFalse(
            condition: $disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $prev = new CarouselPrevious(asChild: true);

        $this->assertTrue(
            condition: $prev->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $prev = new CarouselPrevious(asChild: false);

        $this->assertFalse(
            condition: $prev->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $prev = new CarouselPrevious();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $prev->render(),
            message : 'The Carousel Previous component is not rendered correctly.'
        );
    }
}
