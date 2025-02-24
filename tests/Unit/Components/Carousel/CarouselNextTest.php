<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselNext;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CarouselNextTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_disabled_property()
    {
        $next = new CarouselNext();

        $disabled = (fn() => $this->disabled(['loop' => false], 0))->call($next);

        $this->assertTrue(
            condition: $disabled,
            message  : 'The "disabled" property is not set correctly.'
        );

        $disabled = (fn() => $this->disabled(['loop' => true], 0))->call($next);

        $this->assertFalse(
            condition: $disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $next = new CarouselNext(asChild: true);

        $this->assertTrue(
            condition: $next->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $next = new CarouselNext(asChild: false);

        $this->assertFalse(
            condition: $next->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $next = new CarouselNext();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $next->render(),
            message : 'The Carousel Next component is not rendered correctly.'
        );
    }
}
