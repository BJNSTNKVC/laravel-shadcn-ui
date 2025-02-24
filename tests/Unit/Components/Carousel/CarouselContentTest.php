<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Carousel;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Carousel\CarouselContent;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CarouselContentTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $content = new CarouselContent(asChild: true);

        $this->assertTrue(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $content = new CarouselContent(asChild: false);

        $this->assertFalse(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $content = new CarouselContent();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $content->render(),
            message : 'The Carousel Content component is not rendered correctly.'
        );
    }
}
