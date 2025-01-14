<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Input;

use Illuminate\View\Component;
use Illuminate\View\View;

class Input extends Component
{
    /**
     * The style theme of the button.
     *
     * @var string
     */
    public string $theme;

    /**
     * Create a new component instance.
     */
    public function __construct(string $theme = 'default')
    {
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return $this->view('shadcn-ui::components.input.input');
    }
}
