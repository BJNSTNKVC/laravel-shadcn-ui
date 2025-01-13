<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Support;

use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionItem;
use Bjnstnkvc\ShadcnUi\View\Components\Collapsible\Collapsible;

trait ResetsComponentIndex
{
    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        AccordionItem::reset();
        Collapsible::reset();
    }
}
