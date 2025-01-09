<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\Breadcrumb;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbEllipsis;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbItem;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbLink;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbList;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbPage;
use Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb\BreadcrumbSeparator;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $breadcrumb = new Breadcrumb(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $breadcrumb->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $breadcrumb = new Breadcrumb(asChild: true);

        $this->assertTrue(
            condition: $breadcrumb->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $breadcrumb = new Breadcrumb(asChild: false);

        $this->assertFalse(
            condition: $breadcrumb->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $breadcrumb = $this->component(class: Breadcrumb::class, data: ['theme' => 'New York']);

        $components = [
            'Breadcrumb Ellipsis'  => $this->component(class: BreadcrumbEllipsis::class),
            'Breadcrumb Item'      => $this->component(class: BreadcrumbItem::class),
            'Breadcrumb Link'      => $this->component(class: BreadcrumbLink::class),
            'Breadcrumb List'      => $this->component(class: BreadcrumbList::class),
            'Breadcrumb Page'      => $this->component(class: BreadcrumbPage::class),
            'Breadcrumb Separator' => $this->component(class: BreadcrumbSeparator::class),
        ];

        foreach ($components as $name => $component) {
            $this->assertTrue(
                condition: $component->theme === $breadcrumb->theme,
                message  : "The data is not shared correctly for $name component."
            );
        }
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $breadcrumb = new Breadcrumb();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $breadcrumb->render(),
            message : 'The Breadcrumb component is not rendered correctly.'
        );
    }
}
