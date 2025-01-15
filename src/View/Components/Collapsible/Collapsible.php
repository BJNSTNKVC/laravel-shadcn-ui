<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Collapsible;

use Bjnstnkvc\ShadcnUi\View\Concerns\HasID;
use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Collapsible extends Component
{
    use HasID;
    use SharesData;

    /**
     * The style theme of the component.
     *
     * @var string
     */
    public string $theme;

    /**
     * The controlled open state of the collapsible.
     *
     * @var bool|string
     */
    public bool|string $open;

    /**
     * When true, prevents the user from interacting with the collapsible.
     *
     * @var bool
     */
    public bool $disabled;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(string $theme = 'default', bool|string $open = false, bool $disabled = false, bool $asChild = false)
    {
        $this->id       = $this->id('collapsible');
        $this->theme    = $theme;
        $this->open     = is_string($open) ? json_decode($open) : $open;
        $this->disabled = $disabled;
        $this->asChild  = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views   : [
                'shadcn-ui::components.collapsible.collapsible',
                'shadcn-ui::components.collapsible.collapsible-trigger',
                'shadcn-ui::components.collapsible.collapsible-content',
            ],
            callback: fn(array $data, View $view) => [
                'id'       => $this->id,
                'theme'    => $this->theme,
                'state'    => $this->open ? 'open' : 'closed',
                'disabled' => $this->disabled,
            ]
        );

        return $this->view('shadcn-ui::components.collapsible.collapsible');
    }
}
