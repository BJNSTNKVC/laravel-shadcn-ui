<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardTitle;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CardTitleTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $title = new CardTitle(asChild: true);

        $this->assertTrue(
            condition: $title->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $title = new CardTitle(asChild: false);

        $this->assertFalse(
            condition: $title->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $title = new CardTitle();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $title->render(),
            message : 'The Card Title component is not rendered correctly.'
        );
    }
}
