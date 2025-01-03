<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Alert;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Alert\AlertTitle;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AlertTitleTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $title = new AlertTitle(asChild: true);

        $this->assertTrue(
            condition: $title->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $title = new AlertTitle(asChild: false);

        $this->assertFalse(
            condition: $title->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $title = new AlertTitle();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $title->render(),
            message : 'The Alert Title component is not rendered correctly.'
        );
    }
}
