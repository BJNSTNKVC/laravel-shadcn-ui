<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Alert;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Alert extends Component
{
    use SharesData;

    /**
     * The style theme of the component..
     *
     * @var string
     */
    public string $theme;

    /**
     * The variant of the alert.
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
        $this->share(
            views   : [
                'shadcn-ui::components.alert.alert-title',
                'shadcn-ui::components.alert.alert-description',
            ],
            callback: fn(array $data, View $view) => [
                'theme' => $this->theme,
            ]
        );

        return $this->view('shadcn-ui::components.alert.alert');
    }
}
