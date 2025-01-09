<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 */
class BreadcrumbSeparator extends Component
{
    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     *
     * @param bool $asChild
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
        return $this->view('shadcn-ui::components.breadcrumb.breadcrumb-separator');
    }
}
