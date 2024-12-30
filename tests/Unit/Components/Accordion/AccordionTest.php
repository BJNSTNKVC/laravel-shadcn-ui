<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Accordion\Accordion;
use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionContent;
use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionItem;
use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionTrigger;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AccordionTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_the_theme_property()
    {
        $accordion = new Accordion(theme: 'New York', asChild: 'hello');

        $this->assertEquals(
            expected: 'New York',
            actual  : $accordion->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_type_property()
    {
        $accordion = new Accordion(type: 'multiple');

        $this->assertEquals(
            expected: 'multiple',
            actual  : $accordion->type,
            message : 'The "type" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_value_property()
    {
        $accordion = new Accordion(value: 'item-1');

        $this->assertEquals(
            expected: 'item-1',
            actual  : $accordion->value,
            message : 'The "value" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_collapsible_property()
    {
        $accordion = new Accordion(collapsible: true);

        $this->assertTrue(
            condition: $accordion->collapsible,
            message  : 'The "collapsible" property is not set correctly.'
        );

        $accordion = new Accordion(collapsible: false);

        $this->assertFalse(
            condition: $accordion->collapsible,
            message  : 'The "collapsible" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_disabled_property()
    {
        $accordion = new Accordion(disabled: true);

        $this->assertTrue(
            condition: $accordion->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );

        $accordion = new Accordion(disabled: false);

        $this->assertFalse(
            condition: $accordion->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_direction_property()
    {
        $accordion = new Accordion(direction: 'rtl');

        $this->assertEquals(
            expected: 'rtl',
            actual  : $accordion->direction,
            message : 'The "direction" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_orientation_property()
    {
        $accordion = new Accordion(orientation: 'horizontal');

        $this->assertEquals(
            expected: 'horizontal',
            actual  : $accordion->orientation,
            message : 'The "orientation" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $accordion = new Accordion(asChild: true);

        $this->assertTrue(
            condition: $accordion->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $accordion = new Accordion(asChild: false);

        $this->assertFalse(
            condition: $accordion->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $data = [
            'theme'       => 'New York',
            'type'        => 'single',
            'value'       => 'item-1',
            'disabled'    => true,
            'orientation' => 'vertical',
        ];

        $accordion = $this->component(class: Accordion::class, data: $data);
        $item      = $this->component(class: AccordionItem::class, data: ['value' => 'item-1']);
        $trigger   = $this->component(class: AccordionTrigger::class);
        $content   = $this->component(class: AccordionContent::class);

        $this->assertTrue(
            condition: [$item->theme, $item->type, $item->disabled, $item->orientation] === [$accordion->theme, $accordion->type, $accordion->disabled, $accordion->orientation],
            message  : 'The data is not shared correctly for Accordion Item component.'
        );

        $shared = [$item->id, $accordion->theme, $accordion->type, $item->state, $accordion->disabled, $accordion->orientation];

        $this->assertTrue(
            condition: [$trigger->id, $trigger->theme, $trigger->type, $trigger->state, $trigger->disabled, $trigger->orientation] === $shared,
            message  : 'The data is not shared correctly for Accordion Trigger component.'
        );

        $this->assertTrue(
            condition: [$content->id, $content->theme, $content->type, $content->state, $content->disabled, $content->orientation] === $shared,
            message  : 'The data is not shared correctly for Accordion Content component.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $accordion = new Accordion();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $accordion->render(),
            message : 'The Accordion component is not rendered correctly.'
        );
    }
}
