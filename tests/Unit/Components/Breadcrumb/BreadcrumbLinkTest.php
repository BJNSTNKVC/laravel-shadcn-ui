<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbLink;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbLinkTest extends TestCase
{
    #[Test]
    public function it_sets_the_as_child_property()
    {
        $link = new BreadcrumbLink(asChild: true);

        $this->assertTrue(
            condition: $link->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $link = new BreadcrumbLink(asChild: false);

        $this->assertFalse(
            condition: $link->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $link = new BreadcrumbLink();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $link->render(),
            message : 'The Breadcrumb Link component is not rendered correctly.'
        );
    }
}
