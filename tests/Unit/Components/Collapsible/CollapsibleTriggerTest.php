<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Collapsible\CollapsibleTrigger;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CollapsibleTriggerTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $trigger = new CollapsibleTrigger(asChild: true);

        $this->assertTrue(
            condition: $trigger->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $trigger = new CollapsibleTrigger(asChild: false);

        $this->assertFalse(
            condition: $trigger->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $trigger = new CollapsibleTrigger();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $trigger->render(),
            message : 'The Collapsible Trigger component is not rendered correctly.'
        );
    }
}
