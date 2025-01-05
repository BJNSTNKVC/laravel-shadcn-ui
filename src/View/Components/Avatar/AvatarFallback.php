<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Avatar;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 */
class AvatarFallback extends Component
{
    use SharesData;

    /**
     * Useful for delaying rendering so it only appears for those with slower connections.
     *
     * @var int|string
     */
    public int $delay;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(int $delay = 0, bool $asChild = false)
    {
        $this->delay   = $delay;
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views   : [
                'shadcn-ui::components.avatar.avatar',
            ],
            callback: fn(array $data, View $view) => [
                'delay' => $this->delay,
            ]
        );

        return $this->view('shadcn-ui::components.avatar.avatar-fallback');
    }
}
