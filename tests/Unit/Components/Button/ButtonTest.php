<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Button;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Alert\Alert;
use Bjnstnkvc\ShadcnUi\View\Components\Button\Button;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class ButtonTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $button = new Button(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $button->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_variant_property()
    {
        $button = new Button(variant: 'destructive');

        $this->assertEquals(
            expected: 'destructive',
            actual  : $button->variant,
            message : 'The "variant" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_size_property()
    {
        $button = new Button(size: 'sm');

        $this->assertEquals(
            expected: 'sm',
            actual  : $button->size,
            message : 'The "size" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $button = new Button(asChild: true);

        $this->assertTrue(
            condition: $button->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $button = new Alert(asChild: false);

        $this->assertFalse(
            condition: $button->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $button = new Button();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $button->render(),
            message : 'The Button component is not rendered correctly.'
        );
    }
}
