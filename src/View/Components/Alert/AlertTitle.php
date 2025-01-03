<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Alert;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 */
class AlertTitle extends Component
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
        return $this->view('shadcn-ui::components.alert.alert-title');
    }
}
