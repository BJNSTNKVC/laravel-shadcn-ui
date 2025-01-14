<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Input;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Input\Input;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class InputTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $input = new Input(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $input->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $input = new Input();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $input->render(),
            message : 'The Input component is not rendered correctly.'
        );
    }
}
