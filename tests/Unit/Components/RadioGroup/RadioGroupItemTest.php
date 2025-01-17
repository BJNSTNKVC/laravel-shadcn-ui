<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\RadioGroup\RadioGroup;
use Bjnstnkvc\ShadcnUi\View\Components\RadioGroup\RadioGroupIndicator;
use Bjnstnkvc\ShadcnUi\View\Components\RadioGroup\RadioGroupItem;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class RadioGroupItemTest extends TestCase
{
    #[Test]
    public function it_sets_the_value_property()
    {
        $item = new RadioGroupItem(value: 'item-1');

        $this->assertEquals(
            expected: 'item-1',
            actual  : $item->value,
            message : 'The "value" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_disabled_property()
    {
        $item = new RadioGroupItem(disabled: true);

        $this->assertTrue(
            condition: $item->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );

        $item = new RadioGroupItem(disabled: false);

        $this->assertFalse(
            condition: $item->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_required_property()
    {
        $item = new RadioGroupItem(required: true);

        $this->assertTrue(
            condition: $item->required,
            message  : 'The "required" property is not set correctly.'
        );

        $item = new RadioGroupItem(required: false);

        $this->assertFalse(
            condition: $item->required,
            message  : 'The "required" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_other_components()
    {
        $data = [
            'theme'    => 'New York',
            'disabled' => true,
            'required' => true,
        ];

        $group     = $this->component(class: RadioGroup::class, data: $data);
        $item      = $this->component(class: RadioGroupItem::class);
        $indicator = $this->component(class: RadioGroupIndicator::class);

        $shared = [$group->theme, $group->disabled, $group->required];

        $this->assertTrue(
            condition: [$item->theme, $item->disabled, $item->required] === $shared,
            message  : 'The data is not shared correctly for Radio Group Indicator component.'
        );

        $this->assertTrue(
            condition: [$indicator->theme, $indicator->disabled, $indicator->required] === $shared,
            message  : 'The data is not shared correctly for Radio Group Indicator component.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $item = new RadioGroupItem();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $item->render(),
            message : 'The Radio Group Indicator component is not rendered correctly.'
        );
    }
}
