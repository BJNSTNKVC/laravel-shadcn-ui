<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\RadioGroup\RadioGroupIndicator;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupIndicatorTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $indicator = new RadioGroupIndicator(asChild: true);

        $this->assertTrue(
            condition: $indicator->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $indicator = new RadioGroupIndicator(asChild: false);

        $this->assertFalse(
            condition: $indicator->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $indicator = new RadioGroupIndicator();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $indicator->render(),
            message : 'The Radio Group Indicator component is not rendered correctly.'
        );
    }
}
