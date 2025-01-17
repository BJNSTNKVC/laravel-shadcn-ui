<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\RadioGroup;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 * @property-read bool   $checked
 * @property-read string $state
 * @property-read string $orientation
 */
class RadioGroupItem extends Component
{
    use SharesData;

    /**
     * The value given as data when submitted with a name.
     *
     * @var null|string
     */
    public null|string $value;

    /**
     * When true, prevents the user from interacting with the radio item.
     *
     * @var bool
     */
    public bool $disabled;

    /**
     * When true, indicates that the user must check the radio item before the owning form can be submitted.
     *
     * @var bool
     */
    public bool $required;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(null|string $value = null, bool $disabled = false, bool $required = false, bool $asChild = false)
    {
        $this->value    = $value;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->asChild  = $asChild;
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
                'checked'  => $checked = !is_null($this->value) && $data['_value'] === $this->value,
                'disabled' => $data['_disabled'] ?? $this->disabled,
                'required' => $data['_required'] ?? $this->required,
                'state'    => $checked ? 'checked' : 'unchecked',
            ]
        );

        return $this->view('shadcn-ui::components.radio-group.radio-group-item');
    }
}
