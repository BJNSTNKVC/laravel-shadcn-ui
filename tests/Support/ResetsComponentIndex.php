<?php

namespace Bjnstnkvc\ShadcnUi\Tests\Support;

use Bjnstnkvc\ShadcnUi\View\Components\Accordion\AccordionItem;

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
    }
}
