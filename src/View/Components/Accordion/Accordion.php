<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Accordion;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Accordion extends Component
{
    use SharesData;

    /**
     * The style theme of the component.
     *
     * @var string
     */
    public string $theme;

    /**
     * Determines whether one or multiple items can be opened at the same time.
     *
     * @var string
     */
    public string $type;

    /**
     * The value of the item to expand when initially rendered.
     *
     * @var string|array|null
     */
    public string|array|null $value;

    /**
     * When type is "single", allows closing content when clicking trigger for an open item.
     *
     * @var bool
     */
    public bool $collapsible;

    /**
     * When true, prevents the user from interacting with the accordion and all its items.
     *
     * @var bool
     */
    public bool $disabled;

    /**
     * The reading direction of the accordion when applicable. If omitted, assumes LTR (left-to-right) reading mode.
     *
     * @var string
     */
    public string $direction;

    /**
     * The orientation of the accordion.
     *
     * @var string
     */
    public string $orientation;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $theme = 'default',
        string $type = 'single',
        string|array|null $value = null,
        bool $collapsible = false,
        bool $disabled = false,
        string $direction = 'ltr',
        string $orientation = 'vertical',
        bool $asChild = false,
    ) {
        $this->theme       = $theme;
        $this->type        = $type;
        $this->value       = $value;
        $this->collapsible = $collapsible;
        $this->disabled    = $disabled;
        $this->direction   = $direction;
        $this->orientation = $orientation;
        $this->asChild     = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views   : [
                'shadcn-ui::components.accordion.accordion-item',
                'shadcn-ui::components.accordion.accordion-trigger',
                'shadcn-ui::components.accordion.accordion-content',
            ],
            callback: fn(array $data, View $view) => [
                'theme'       => $this->theme,
                'type'        => $this->type,
                '_value'      => $this->value,
                '_disabled'   => $this->disabled,
                'orientation' => $this->orientation,
            ]
        );

        return $this->view('shadcn-ui::components.accordion.accordion');
    }
}
