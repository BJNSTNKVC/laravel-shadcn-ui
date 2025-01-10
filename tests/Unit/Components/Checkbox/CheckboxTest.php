<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Checkbox;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Checkbox\Checkbox;
use Bjnstnkvc\ShadcnUi\View\Components\Checkbox\CheckboxIndicator;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CheckboxTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $checkbox = new Checkbox(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $checkbox->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_checked_property()
    {
        $checkbox = new Checkbox(checked: true);

        $this->assertTrue(
            condition: $checkbox->checked,
            message  : 'The "checked" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_disabled_property()
    {
        $checkbox = new Checkbox(disabled: true);

        $this->assertTrue(
            condition: $checkbox->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_state_property()
    {
        $values = [
            'indeterminate' => null,
            'checked'       => true,
            'unchecked'     => false,
        ];

        foreach ($values as $state => $checked) {
            $checkbox = new Checkbox(checked: $checked);

            $value = (fn() => $this->state())->call($checkbox);

            $this->assertTrue(
                condition: $state === $value,
                message  : 'The "value" property is not set correctly.'
            );
        }
    }

    #[Test]
    public function it_sets_the_required_property()
    {
        $checkbox = new Checkbox(required: true);

        $this->assertTrue(
            condition: $checkbox->required,
            message  : 'The "required" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_value_property()
    {
        $checkbox = new Checkbox(value: 'yes');

        $this->assertEquals(
            expected: 'yes',
            actual  : $checkbox->value,
            message : 'The "value" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $checkbox = new Checkbox(asChild: true);

        $this->assertTrue(
            condition: $checkbox->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $checkbox = new Checkbox(asChild: false);

        $this->assertFalse(
            condition: $checkbox->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $data = [
            'theme'    => 'New York',
            'value'    => 'yes',
            'checked'  => true,
            'disabled' => true,
        ];

        $checkbox  = $this->component(class: Checkbox::class, data: $data);
        $indicator = $this->component(class: CheckboxIndicator::class);

        $this->assertTrue(
            condition: [$indicator->theme, $indicator->value, $indicator->checked, $indicator->disabled] === [$checkbox->theme, $checkbox->value, $checkbox->checked, $checkbox->disabled],
            message  : 'The data is not shared correctly for Checkbox Indicator component.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $checkbox = new Checkbox();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $checkbox->render(),
            message : 'The Checkbox component is not rendered correctly.'
        );
    }
}
