<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\AspectRatio;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\AspectRatio\AspectRatio;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AspectRatioTest extends TestCase
{
    #[Test]
    public function it_sets_the_ratio_property()
    {
        $aspect = new AspectRatio(ratio: 16 / 9);

        $this->assertEquals(
            expected: floatval(16 / 9),
            actual  : $aspect->ratio,
            message : 'The "ratio" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $aspect = new AspectRatio(asChild: true);

        $this->assertTrue(
            condition: $aspect->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $aspect = new AspectRatio(asChild: false);

        $this->assertFalse(
            condition: $aspect->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_component()
    {
        $aspect = new AspectRatio();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $aspect->render(),
            message : 'The Aspect Ratio component is not rendered correctly.'
        );
    }
}
