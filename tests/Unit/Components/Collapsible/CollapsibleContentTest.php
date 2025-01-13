<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Collapsible\CollapsibleContent;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CollapsibleContentTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $content = new CollapsibleContent(asChild: true);

        $this->assertTrue(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $content = new CollapsibleContent(asChild: false);

        $this->assertFalse(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $content = new CollapsibleContent();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $content->render(),
            message : 'The Collapsible Content component is not rendered correctly.'
        );
    }
}
