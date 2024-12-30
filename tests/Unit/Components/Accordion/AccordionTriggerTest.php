<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionTrigger;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AccordionTriggerTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $trigger = new AccordionTrigger(asChild: true);

        $this->assertTrue(
            condition: $trigger->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $trigger = new AccordionTrigger(asChild: false);

        $this->assertFalse(
            condition: $trigger->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $trigger = new AccordionTrigger();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $trigger->render(),
            message : 'The Accordion Trigger component is not rendered correctly.'
        );
    }
}
