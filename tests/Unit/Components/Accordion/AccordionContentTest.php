<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Accordion;

use Bjnstnkvc\ShadcnUi\Tests\Support\ResetsComponentIndex;
use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionContent;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AccordionContentTest extends TestCase
{
    use ResetsComponentIndex;

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $content = new AccordionContent(asChild: true);

        $this->assertTrue(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $content = new AccordionContent(asChild: false);

        $this->assertFalse(
            condition: $content->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $content = new AccordionContent();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $content->render(),
            message : 'The Accordion Content component is not rendered correctly.'
        );
    }
}
