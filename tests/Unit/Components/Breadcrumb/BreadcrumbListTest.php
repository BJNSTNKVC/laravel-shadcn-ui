<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbList;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbListTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $list = new BreadcrumbList(asChild: true);

        $this->assertTrue(
            condition: $list->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $list = new BreadcrumbList(asChild: false);

        $this->assertFalse(
            condition: $list->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $list = new BreadcrumbList();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $list->render(),
            message : 'The Breadcrumb List component is not rendered correctly.'
        );
    }
}
