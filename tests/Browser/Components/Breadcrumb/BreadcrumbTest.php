<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Browser\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Test;

class BreadcrumbTest extends DuskTestCase
{
    #[Test]
    public function it_renders_the_component(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-breadcrumb>
                    <x-breadcrumb-list>
                        <x-breadcrumb-item>
                            <x-breadcrumb-link href="/">Home</x-breadcrumb-link>
                        </x-breadcrumb-item>
                        <x-breadcrumb-separator />
                        <x-breadcrumb-item>
                            <x-breadcrumb-link href="/components">Components</x-breadcrumb-link>
                        </x-breadcrumb-item>
                        <x-breadcrumb-separator />
                        <x-breadcrumb-item>
                            <x-breadcrumb-ellipsis />
                        </x-breadcrumb-item>
                        <x-breadcrumb-separator />
                        <x-breadcrumb-item>
                            <x-breadcrumb-page>Breadcrumb</x-breadcrumb-page>
                        </x-breadcrumb-item>
                    </x-breadcrumb-list>
                </x-breadcrumb>
            HTML;

            $browser->visit($this->component($template))
                ->assertSeeLink('Home')
                ->assertSeeLink('Components')
                ->assertSee('Breadcrumb');
        });
    }

    #[Test]
    public function it_can_be_themed(): void
    {
        $this->browse(function (Browser $browser) {
            $template = <<<'HTML'
                <x-breadcrumb theme="New York" dusk="breadcrumb">
                    <x-breadcrumb-list>
                        <x-breadcrumb-item>
                            <x-breadcrumb-link href="/">Home</x-breadcrumb-link>
                        </x-breadcrumb-item>
                        <x-breadcrumb-separator />
                        <x-breadcrumb-item>
                            <x-breadcrumb-link href="/components">Components</x-breadcrumb-link>
                        </x-breadcrumb-item>
                        <x-breadcrumb-separator />
                        <x-breadcrumb-item>
                            <x-breadcrumb-ellipsis />
                        </x-breadcrumb-item>
                        <x-breadcrumb-separator />
                        <x-breadcrumb-item>
                            <x-breadcrumb-page>Breadcrumb</x-breadcrumb-page>
                        </x-breadcrumb-item>
                    </x-breadcrumb-list>
                </x-breadcrumb>
            HTML;

            $browser->visit($this->component($template))
                ->assertAttributeContains('@breadcrumb ol', 'class', 'text-sm');
        });
    }
}