<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Badge;

use Illuminate\View\Component;
use Illuminate\View\View;

class Badge extends Component
{
    /**
     * The style theme of the badge.
     *
     * @var string
     */
    public string $theme;

    /**
     * The variant of the badge.
     *
     * @var string
     */
    public string $variant;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(string $theme = 'default', string $variant = 'default', bool $asChild = false)
    {
        $this->theme   = $theme;
        $this->variant = $variant;
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return $this->view('shadcn-ui::components.badge.badge');
    }
}
