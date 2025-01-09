<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbItem;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbItemTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $item = new BreadcrumbItem(asChild: true);

        $this->assertTrue(
            condition: $item->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $item = new BreadcrumbItem(asChild: false);

        $this->assertFalse(
            condition: $item->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $item = new BreadcrumbItem();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $item->render(),
            message : 'The Breadcrumb Item component is not rendered correctly.'
        );
    }
}
