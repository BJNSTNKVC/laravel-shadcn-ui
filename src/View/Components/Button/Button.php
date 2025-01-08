<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Button;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    /**
     * The style theme of the button.
     *
     * @var string
     */
    public string $theme;

    /**
     * The variant of the button.
     *
     * @var string
     */
    public string $variant;

    /**
     * The size of the button.
     *
     * @var string
     */
    public string $size;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     *
     * @param string $theme
     * @param string $variant
     * @param string $size
     * @param bool   $asChild
     */
    public function __construct(string $theme = 'default', string $variant = 'default', string $size = 'default', bool $asChild = false)
    {
        $this->theme   = $theme;
        $this->variant = $variant;
        $this->size    = $size;
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return $this->view('shadcn-ui::components.button.button');
    }
}
