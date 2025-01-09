<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbEllipsis;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbEllipsisTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $ellipsis = new BreadcrumbEllipsis(asChild: true);

        $this->assertTrue(
            condition: $ellipsis->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $ellipsis = new BreadcrumbEllipsis(asChild: false);

        $this->assertFalse(
            condition: $ellipsis->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $ellipsis = new BreadcrumbEllipsis();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $ellipsis->render(),
            message : 'The Breadcrumb Ellipsis component is not rendered correctly.'
        );
    }
}
