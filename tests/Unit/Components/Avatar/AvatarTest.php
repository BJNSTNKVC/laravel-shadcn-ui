<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Avatar;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Avatar\Avatar;
use Bjnstnkvc\ShadcnUi\View\Components\Avatar\AvatarFallback;
use Bjnstnkvc\ShadcnUi\View\Components\Avatar\AvatarImage;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AvatarTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $avatar = new Avatar(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $avatar->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $avatar = new Avatar(asChild: true);

        $this->assertTrue(
            condition: $avatar->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $avatar = new Avatar(asChild: false);

        $this->assertFalse(
            condition: $avatar->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $avatar   = $this->component(class: Avatar::class, data: ['theme' => 'New York']);
        $image    = $this->component(class: AvatarImage::class);
        $fallback = $this->component(class: AvatarFallback::class);

        $this->assertTrue(
            condition: $image->theme === $avatar->theme,
            message  : 'The data is not shared correctly for Avatar Image component.'
        );

        $this->assertTrue(
            condition: $fallback->theme === $avatar->theme,
            message  : 'The data is not shared correctly for Avatar Fallback component.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $avatar = new Avatar();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $avatar->render(),
            message : 'The Avatar component is not rendered correctly.'
        );
    }
}
