<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Alert;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Alert\AlertDescription;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AlertDescriptionTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $description = new AlertDescription(asChild: true);

        $this->assertTrue(
            condition: $description->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $description = new AlertDescription(asChild: false);

        $this->assertFalse(
            condition: $description->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $description = new AlertDescription();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $description->render(),
            message : 'The Alert Description component is not rendered correctly.'
        );
    }
}
