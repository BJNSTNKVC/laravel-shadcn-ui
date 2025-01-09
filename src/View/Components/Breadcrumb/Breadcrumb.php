<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Breadcrumb;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Breadcrumb extends Component
{
    use SharesData;

    /**
     * The style theme of the button.
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
     *
     * @param string $theme
     */
    public function __construct(string $theme = 'default', bool $asChild = false)
    {
        $this->theme = $theme;
        $this->asChild = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views: [
                'shadcn-ui::components.breadcrumb.breadcrumb-list',
                'shadcn-ui::components.breadcrumb.breadcrumb-item',
                'shadcn-ui::components.breadcrumb.breadcrumb-link',
                'shadcn-ui::components.breadcrumb.breadcrumb-page',
                'shadcn-ui::components.breadcrumb.breadcrumb-separator',
                'shadcn-ui::components.breadcrumb.breadcrumb-ellipsis',
            ],
            callback: fn(array $data, View $view) => [
                'theme' => $this->theme,
            ]
        );

        return $this->view('shadcn-ui::components.breadcrumb.breadcrumb');
    }
}
