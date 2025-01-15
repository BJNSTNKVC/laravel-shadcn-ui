<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Label;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Label\Label;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class LabelTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $label = new Label(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $label->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_for_property()
    {
        $label = new Label(for: 'email');

        $this->assertEquals(
            expected: 'email',
            actual  : $label->for,
            message : 'The "email" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $label = new Label();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $label->render(),
            message : 'The Label component is not rendered correctly.'
        );
    }
}
