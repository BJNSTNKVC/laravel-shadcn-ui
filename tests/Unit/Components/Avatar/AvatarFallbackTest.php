<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Avatar;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Avatar\AvatarFallback;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AvatarFallbackTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $fallback = new AvatarFallback(asChild: true);

        $this->assertTrue(
            condition: $fallback->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $fallback = new AvatarFallback(asChild: false);

        $this->assertFalse(
            condition: $fallback->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $fallback = new AvatarFallback();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $fallback->render(),
            message : 'The Avatar Fallback component is not rendered correctly.'
        );
    }
}
