<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\AspectRatio;

use Illuminate\View\Component;
use Illuminate\View\View;

class AspectRatio extends Component
{
    /**
     * The desired ratio
     *
     * @var float
     */
    public float $ratio;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(float $ratio = 1, bool $asChild = false)
    {
        $this->ratio   = $ratio;
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return $this->view('shadcn-ui::components.aspect-ratio.aspect-ratio');
    }
}
