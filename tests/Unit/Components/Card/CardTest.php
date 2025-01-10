<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Unit\Components\Card;

use Bjnstnkvc\ShadcnUi\Tests\TestCase;
use Bjnstnkvc\ShadcnUi\View\Components\Card\Card;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardContent;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardDescription;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardFooter;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardHeader;
use Bjnstnkvc\ShadcnUi\View\Components\Card\CardTitle;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;

class CardTest extends TestCase
{
    #[Test]
    public function it_sets_the_theme_property()
    {
        $card = new Card(theme: 'New York');

        $this->assertEquals(
            expected: 'New York',
            actual  : $card->theme,
            message : 'The "theme" property is not set correctly.'
        );
    }

    #[Test]
    public function it_sets_the_as_child_property()
    {
        $card = new Card(asChild: true);

        $this->assertTrue(
            condition: $card->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );

        $card = new Card(asChild: false);

        $this->assertFalse(
            condition: $card->asChild,
            message  : 'The "asChild" property is not set correctly.'
        );
    }

    #[Test]
    public function it_shares_the_data_with_child_components()
    {
        $card = $this->component(class: Card::class, data: ['theme' => 'New York']);

        $components = [
            'Card Content'     => $this->component(class: CardContent::class),
            'Card Description' => $this->component(class: CardDescription::class),
            'Card Footer'      => $this->component(class: CardFooter::class),
            'Card Header'      => $this->component(class: CardHeader::class),
            'Card Title'       => $this->component(class: CardTitle::class),
        ];

        foreach ($components as $name => $component) {
            $this->assertTrue(
                condition: $component->theme === $card->theme,
                message  : "The data is not shared correctly for $name component."
            );
        }
    }

    #[Test]
    public function it_can_render_the_component()
    {
        $card = new Card();

        $this->assertInstanceOf(
            expected: View::class,
            actual  : $card->render(),
            message : 'The Card component is not rendered correctly.'
        );
    }
}
