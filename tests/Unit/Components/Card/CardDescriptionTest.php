<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardDescription;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CardDescriptionTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $description = new CardDescription(asChild: true);

        $this->assertTrue(
            condition: $description->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $description = new CardDescription(asChild: false);

        $this->assertFalse(
            condition: $description->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $description = new CardDescription();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $description->render(),
            message : 'The Card Description component is not rendered correctly.'
        );
    }
}
