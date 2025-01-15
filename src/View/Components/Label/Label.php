<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Label;

use Illuminate\View\Component;
use Illuminate\View\View;

class Label extends Component
{
    /**
     * The style theme of the button.
     *
     * @var string
     */
    public string $theme;

    /**
     * The id of the element the label is associated with.
     *
     * @var null|string
     */
    public null|string $for;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(string $theme = 'default', null|string $for = null, bool $asChild = false)
    {
        $this->for     = $for;
        $this->theme   = $theme;
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return $this->view('shadcn-ui::components.label.label');
    }
}
