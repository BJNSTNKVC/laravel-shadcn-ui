<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Avatar;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Avatar\AvatarImage;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AvatarImageTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $image = new AvatarImage(asChild: true);

        $this->assertTrue(
            condition: $image->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $image = new AvatarImage(asChild: false);

        $this->assertFalse(
            condition: $image->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $image = new AvatarImage();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $image->render(),
            message : 'The Avatar Image component is not rendered correctly.'
        );
    }
}
