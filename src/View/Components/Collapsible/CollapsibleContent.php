<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Collapsible;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 * @property-read string $state
 * @property-read bool   $disabled
 */
class CollapsibleContent extends Component
{
    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $asChild = false)
    {
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return $this->view('shadcn-ui::components.collapsible.collapsible-content');
    }
}
