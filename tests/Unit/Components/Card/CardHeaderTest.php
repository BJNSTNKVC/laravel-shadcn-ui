<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardHeader;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CardHeaderTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $header = new CardHeader(asChild: true);

        $this->assertTrue(
            condition: $header->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $header = new CardHeader(asChild: false);

        $this->assertFalse(
            condition: $header->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $header = new CardHeader();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $header->render(),
            message : 'The Card Header component is not rendered correctly.'
        );
    }
}
