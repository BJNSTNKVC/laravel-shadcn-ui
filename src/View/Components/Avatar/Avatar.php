<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Avatar;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Avatar extends Component
{
    use SharesData;

    /**
     * The style theme of the component..
     *
     * @var string
     */
    public string $theme;

    /**
     * Useful for delaying rendering so it only appears for those with slower connections.
     *
     * @var int
     */
    public int $delay = 0;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(string $theme = 'default', bool $asChild = false)
    {
        $this->theme   = $theme;
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views   : [
                'shadcn-ui::components.avatar.avatar-image',
                'shadcn-ui::components.avatar.avatar-fallback',
            ],
            callback: fn(array $data, View $view) => [
                'theme' => $this->theme,
            ]
        );

        return $this->view('shadcn-ui::components.avatar.avatar');
    }
}
