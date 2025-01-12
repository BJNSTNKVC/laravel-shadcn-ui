<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Checkbox;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Checkbox\CheckboxIndicator;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CheckboxIndicatorTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $checkbox = new CheckboxIndicator(asChild: true);

        $this->assertTrue(
            condition: $checkbox->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $checkbox = new CheckboxIndicator(asChild: false);

        $this->assertFalse(
            condition: $checkbox->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $checkbox = new CheckboxIndicator();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $checkbox->render(),
            message : 'The Checkbox Indicator component is not rendered correctly.'
        );
    }
}
