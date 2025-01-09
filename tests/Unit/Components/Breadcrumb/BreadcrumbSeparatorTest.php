<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbSeparator;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbSeparatorTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $page = new BreadcrumbSeparator(asChild: true);

        $this->assertTrue(
            condition: $page->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $page = new BreadcrumbSeparator(asChild: false);

        $this->assertFalse(
            condition: $page->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $page = new BreadcrumbSeparator();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $page->render(),
            message : 'The Breadcrumb Separator component is not rendered correctly.'
        );
    }
}
