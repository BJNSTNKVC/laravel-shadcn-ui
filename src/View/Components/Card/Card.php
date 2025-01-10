<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Card;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    use SharesData;

    /**
     * The style theme of the alert.
     *
     * @var string
     */
    public string $theme;

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
                'shadcn-ui::components.card.card-content',
                'shadcn-ui::components.card.card-description',
                'shadcn-ui::components.card.card-footer',
                'shadcn-ui::components.card.card-header',
                'shadcn-ui::components.card.card-title',
            ],
            callback: fn(array $data, View $view) => [
                'theme' => $this->theme,
            ]
        );

        return $this->view('shadcn-ui::components.card.card');
    }
}
