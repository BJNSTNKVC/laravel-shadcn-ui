<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Collapsible\Collapsible;
use Bjnstnkvc\ShadcnUi\View\Components\Collapsible\CollapsibleContent;
use Bjnstnkvc\ShadcnUi\View\Components\Collapsible\CollapsibleTrigger;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CollapsibleTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_the_id_property()
    {
        $collapsible = new Collapsible();

        $this->assertEquals(
            expected: 'collapsible-1',
            actual  : $collapsible->id,
            message : 'The "id" property is not set correctly.'
        );
    }

    #[Test]
    public function it_increments_the_id_property()
    {
        new Collapsible();

        $collapsible = new Collapsible();

        $this->assertEquals(
            expected: 'collapsible-2',
            actual  : $collapsible->id,
            message : 'The "id" property is not incremented correctly.'
        );
    }

    #[Test]
    public function it_sets_the_theme_property()
    {
        $collapsible = new Collapsible(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $collapsible->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_open_property()
    {
        $collapsible = new Collapsible(open: true);

        $this->assertTrue(
            condition: $collapsible->open,
            message  : 'The "open" property is not set correctly.'
        );

        $collapsible = new Collapsible(open: false);

        $this->assertFalse(
            condition: $collapsible->open,
            message  : 'The "open" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_disabled_property()
    {
        $collapsible = new Collapsible(disabled: true);

        $this->assertTrue(
            condition: $collapsible->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );

        $collapsible = new Collapsible(disabled: false);

        $this->assertFalse(
            condition: $collapsible->disabled,
            message  : 'The "disabled" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $collapsible = new Collapsible(asChild: true);

        $this->assertTrue(
            condition: $collapsible->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $collapsible = new Collapsible(asChild: false);

        $this->assertFalse(
            condition: $collapsible->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $data = [
            'theme'    => 'New York',
            'open'     => true,
            'disabled' => true,
        ];

        $collapsible = $this->component(class: Collapsible::class, data: $data);

        $components = [
            'Collapsible Trigger' => $this->component(class: CollapsibleTrigger::class),
            'Collapsible Content' => $this->component(class: CollapsibleContent::class),
        ];

        $state = $collapsible->open ? 'open' : 'closed';

        foreach ($components as $name => $component) {
            $this->assertTrue(
                condition: [$component->id, $component->theme, $component->state, $component->disabled] === [$collapsible->id, $collapsible->theme, $state, $collapsible->disabled],
                message  : "The data is not shared correctly for $name component."
            );
        }
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $collapsible = new Collapsible();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $collapsible->render(),
            message : 'The Collapsible component is not rendered correctly.'
        );
    }
}
