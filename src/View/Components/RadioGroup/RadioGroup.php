<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class RadioGroup extends Component
{
    use SharesData;

    /**
     * The style theme of the component
     *
     * @var string
     */
    public string $theme;

    /**
     * When true, prevents the user from interacting with radio items.
     *
     * @var bool
     */
    public bool $disabled;

    /**
     * When true, indicates that the user must check a radio item before the owning form can be submitted.
     *
     * @var bool
     */
    public bool $required;

    /**
     * The controlled value of the radio item to check.
     *
     * @var null|string
     */
    public null|string $value;

    /**
     * The orientation of the component.
     *
     * @var string
     */
    public null|string $orientation;

    /**
     * The reading direction of the radio group. If omitted, assumes LTR (left-to-right) reading mode.
     *
     * @var string
     */
    public null|string $direction;

    /**
     * When true, keyboard navigation will loop from last item to first, and vice versa.
     *
     * @var bool|string
     */
    public bool|string $loop;

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
        bool $disabled = false,
        bool $required = false,
        null|string $value = null,
        null|string $orientation = null,
        null|string $direction = 'ltr',
        bool|string $loop = true,
        bool $asChild = false,
    ) {
        $this->theme       = $theme;
        $this->disabled    = $disabled;
        $this->required    = $required;
        $this->value       = $value;
        $this->orientation = $orientation;
        $this->direction   = $direction;
        $this->loop        = is_string($loop) ? json_decode($loop) : $loop;
        $this->asChild     = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views   : [
                'shadcn-ui::components.radio-group.radio-group-item',
                'shadcn-ui::components.radio-group.radio-group-indicator',
            ],
            callback: fn(array $data, View $view) => [
                'theme'       => $this->theme,
                '_value'      => $this->value,
                '_disabled'   => $this->disabled,
                '_required'   => $this->required,
                'orientation' => $this->orientation,
            ]
        );

        return $this->view('shadcn-ui::components.radio-group.radio-group');
    }
}
