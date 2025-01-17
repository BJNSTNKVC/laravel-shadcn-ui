<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\RadioGroup\RadioGroup;
use Bjnstnkvc\ShadcnUi\View\Components\RadioGroup\RadioGroupIndicator;
use Bjnstnkvc\ShadcnUi\View\Components\RadioGroup\RadioGroupItem;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $group = new RadioGroup(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $group->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_disabled_property()
    {
        $group = new RadioGroup(disabled: true);

        $this->assertTrue(
            condition: $group->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );

        $group = new RadioGroup(disabled: false);

        $this->assertFalse(
            condition: $group->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_required_property()
    {
        $group = new RadioGroup(required: true);

        $this->assertTrue(
            condition: $group->required,
            message  : 'The "required" property is not set correctly.'
        );

        $group = new RadioGroup(required: false);

        $this->assertFalse(
            condition: $group->required,
            message  : 'The "required" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_value_property()
    {
        $group = new RadioGroup(value: 'item-1');

        $this->assertEquals(
            expected: 'item-1',
            actual  : $group->value,
            message : 'The "value" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_orientation_property()
    {
        $group = new RadioGroup(orientation: 'horizontal');

        $this->assertEquals(
            expected: 'horizontal',
            actual  : $group->orientation,
            message : 'The "orientation" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_direction_property()
    {
        $group = new RadioGroup(direction: 'rtl');

        $this->assertEquals(
            expected: 'rtl',
            actual  : $group->direction,
            message : 'The "direction" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_loop_property()
    {
        $group = new RadioGroup(loop: true);

        $this->assertTrue(
            condition: $group->loop,
            message  : 'The "loop" property is not set correctly.'
        );

        $group = new RadioGroup(loop: false);

        $this->assertFalse(
            condition: $group->loop,
            message  : 'The "loop" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $group = new RadioGroup(asChild: true);

        $this->assertTrue(
            condition: $group->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $group = new RadioGroup(asChild: false);

        $this->assertFalse(
            condition: $group->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_checked_property()
    {
        $group = $this->component(class: RadioGroup::class, data: ['value' => 'value']);
        $item  = $this->component(class: RadioGroupItem::class, data: ['value' => 'value']);

        $this->assertTrue(
            condition: $item->checked,
            message  : 'The "checked" property is not set correctly.'
        );

        $group = $this->component(class: RadioGroup::class);
        $item  = $this->component(class: RadioGroupItem::class, data: ['value' => 'value']);

        $this->assertFalse(
            condition: $item->checked,
            message  : 'The "checked" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_state_property()
    {
        $group = $this->component(class: RadioGroup::class, data: ['value' => 'item-1']);
        $item  = $this->component(class: RadioGroupItem::class, data: ['value' => 'item-1']);

        $this->assertEquals(
            expected: 'checked',
            actual  : $item->state,
            message : 'The "state" property is not set correctly.'
        );

        $item  = $this->component(class: RadioGroupItem::class, data: ['value' => 'item-2']);

        $this->assertEquals(
            expected: 'unchecked',
            actual  : $item->state,
            message : 'The "state" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $data = [
            'theme'       => 'New York',
            'disabled'    => true,
            'required'    => true,
            'orientation' => 'horizontal',
            'value'       => 'item-1',
        ];

        $group     = $this->component(class: RadioGroup::class, data: $data);
        $item      = $this->component(class: RadioGroupItem::class, data: ['value' => 'item-1']);
        $indicator = $this->component(class: RadioGroupIndicator::class);

        $shared = [$item->checked, $item->disabled, $item->required, $item->state];

        $this->assertTrue(
            condition: [$indicator->checked, $indicator->disabled, $indicator->required, $indicator->state] === $shared,
            message  : 'The data is not shared correctly for RadioGroup Indicator component.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $group = new RadioGroup();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $group->render(),
            message : 'The RadioGroup component is not rendered correctly.'
        );
    }
}
