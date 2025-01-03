<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Alert;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Alert\Alert;
use Bjnstnkvc\ShadcnUi\View\Components\Alert\AlertDescription;
use Bjnstnkvc\ShadcnUi\View\Components\Alert\AlertTitle;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class AlertTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $alert = new Alert(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $alert->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_variant_property()
    {
        $alert = new Alert(variant: 'destructive');

        $this->assertEquals(
            expected: 'destructive',
            actual  : $alert->variant,
            message : 'The "variant" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $alert = new Alert(asChild: true);

        $this->assertTrue(
            condition: $alert->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $alert = new Alert(asChild: false);

        $this->assertFalse(
            condition: $alert->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $alert       = $this->component(class: Alert::class, data: ['theme' => 'New York']);
        $title       = $this->component(class: AlertTitle::class);
        $description = $this->component(class: AlertDescription::class);

        $this->assertTrue(
            condition: $title->theme === $alert->theme,
            message  : 'The data is not shared correctly for Alert Title component.'
        );

        $this->assertTrue(
            condition: $description->theme === $alert->theme,
            message  : 'The data is not shared correctly for Alert Description component.'
        );
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $alert = new Alert();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $alert->render(),
            message : 'The Alert component is not rendered correctly.'
        );
    }
}
