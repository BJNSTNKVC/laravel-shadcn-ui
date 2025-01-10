<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardContent;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CardContentTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $content = new CardContent(asChild: true);

        $this->assertTrue(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $content = new CardContent(asChild: false);

        $this->assertFalse(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $content = new CardContent();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $content->render(),
            message : 'The Card Content component is not rendered correctly.'
        );
    }
}
