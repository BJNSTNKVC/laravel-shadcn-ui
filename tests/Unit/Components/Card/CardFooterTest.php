<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardFooter;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CardFooterTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $footer = new CardFooter(asChild: true);

        $this->assertTrue(
            condition: $footer->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $footer = new CardFooter(asChild: false);

        $this->assertFalse(
            condition: $footer->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $footer = new CardFooter();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $footer->render(),
            message : 'The Card Footer component is not rendered correctly.'
        );
    }
}
