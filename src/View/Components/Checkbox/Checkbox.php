<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Checkbox;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Checkbox extends Component
{
    use SharesData;

    /**
     * The style theme of the alert.
     *
     * @var string
     */
    public string $theme;

    /**
     * The controlled checked state of the checkbox.
     *
     * @var bool|null|string
     */
    public bool|null|string $checked;

    /**
     * When true, prevents the user from interacting with the checkbox.
     *
     * @var bool
     */
    public bool $disabled;

    /**
     * When true, indicates that the user must check the checkbox before the owning form can be submitted.
     *
     * @var bool
     */
    public bool $required;

    /**
     * The value given as data when submitted with a name.
     *
     * @var string
     */
    public string $value;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(string $theme = 'default', bool|null|string $checked = null, bool $disabled = false, bool $required = false, string $value = 'on', bool $asChild = false)
    {
        $this->theme    = $theme;
        $this->checked  = is_string($checked) ? json_decode($checked) : $checked;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->value    = $value;
        $this->asChild  = $asChild;
    }

    /**
     * Determine the state of the checkbox.
     *
     * @return string
     */
    private function state(): string
    {
        if (is_null($this->checked)) {
            return 'indeterminate';
        }

        return $this->checked ? 'checked' : 'unchecked';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views   : [
                'shadcn-ui::components.checkbox.checkbox',
                'shadcn-ui::components.checkbox.checkbox-indicator',
            ],
            callback: fn(array $data, View $view) => [
                'theme'    => $this->theme,
                'value'    => $this->value,
                'checked'  => $this->checked,
                'disabled' => $this->disabled,
                'state'    => $this->state(),
            ]
        );

        return $this->view('shadcn-ui::components.checkbox.checkbox');
    }
}
