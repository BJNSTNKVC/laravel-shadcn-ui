<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionItem;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AccordionItemTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_the_id_property()
    {
        $item = new AccordionItem(value: 'item-1');

        $this->assertEquals(
            expected: 'accordion-item-1',
            actual  : $item->id,
            message : 'The "id" property is not set correctly.'
        );
    }

    #[Test]
    public function it_increments_the_id_property()
    {
        new AccordionItem(value: 'item-1');

        $item = new AccordionItem(value: 'item-2');

        $this->assertEquals(
            expected: 'accordion-item-2',
            actual  : $item->id,
            message : 'The "id" property is not incremented correctly.'
        );
    }

    #[Test]
    public function it_sets_the_value_property()
    {
        $item = new AccordionItem(value: 'item-1');

        $this->assertEquals(
            expected: 'item-1',
            actual  : $item->value,
            message : 'The "value" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_disabled_property()
    {
        $item = new AccordionItem(value: 'item-1', disabled: true);

        $this->assertTrue(
            condition: $item->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );

        $item = new AccordionItem(value: 'item-1', disabled: false);

        $this->assertFalse(
            condition: $item->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_state_property()
    {
        $item = new AccordionItem(value: 'item-1', disabled: true);

        $state = (fn() => $this->state(['type' => 'single', '_value' => null]))->call($item);

        $this->assertTrue(
            condition: $state === 'closed',
            message  : 'The "state" property is not set correctly.'
        );

        $state = (fn() => $this->state(['type' => 'single', '_value' => 'item-1']))->call($item);

        $this->assertTrue(
            condition: $state === 'open',
            message  : 'The "state" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $item = new AccordionItem(value: 'item-1', asChild: true);

        $this->assertTrue(
            condition: $item->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $item = new AccordionItem(value: 'item-1', asChild: false);

        $this->assertFalse(
            condition: $item->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $item = new AccordionItem(value: 'item-1');

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $item->render(),
            message : 'The Accordion Item component is not rendered correctly.'
        );
    }
}
