<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Badge;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Alert\Alert;
use Bjnstnkvc\ShadcnUi\View\Components\Badge\Badge;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class BadgeTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $badge = new Badge(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $badge->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_variant_property()
    {
        $badge = new Badge(variant: 'destructive');

        $this->assertEquals(
            expected: 'destructive',
            actual  : $badge->variant,
            message : 'The "variant" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $badge = new Badge(asChild: true);

        $this->assertTrue(
            condition: $badge->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $badge = new Alert(asChild: false);

        $this->assertFalse(
            condition: $badge->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $badge = new Badge();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $badge->render(),
            message : 'The Badge component is not rendered correctly.'
        );
    }
}
