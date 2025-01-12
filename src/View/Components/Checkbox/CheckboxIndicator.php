<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Checkbox;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string           $theme
 * @property-read string           $value
 * @property-read bool|null|string $checked
 * @property-read bool             $disabled
 */
class CheckboxIndicator extends Component
{
    use SharesData;

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
        return $this->view('shadcn-ui::components.checkbox.checkbox-indicator');
    }
}
