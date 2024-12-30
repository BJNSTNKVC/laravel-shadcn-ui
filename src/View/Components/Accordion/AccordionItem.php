<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Accordion;

use Bjnstnkvc\ShadcnUi\View\Concerns\HasID;
use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 * @property-read string $type
 * @property-read string $state
 * @property-read bool   $disabled
 * @property-read bool   $hidden
 * @property-read string $orientation
 */
class AccordionItem extends Component
{
    use HasID;
    use SharesData;

    /**
     * A unique value for the item.
     *
     * @var string
     */
    public string $value;

    /**
     * When true, prevents the user from interacting with the accordion and all its items.
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
    public function __construct(string $value, bool $disabled = false, bool $asChild = false)
    {
        $this->id       = $this->id('accordion-item');
        $this->value    = $value;
        $this->disabled = $disabled;
        $this->asChild  = $asChild;
    }

    /**
     * Determine the state of the item.
     *
     * @param array $data
     *
     * @return string
     */
    private function state(array $data): string
    {
        if ($data['type'] === 'single' && is_array($data['_value'])) {
            return 'closed';
        }

        if ($data['type'] === 'multiple' && is_array($data['_value'])) {
            return in_array($this->value, $data['_value']) ? 'open' : 'closed';
        }

        return $this->value === $data['_value'] ? 'open' : 'closed';
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
            callback: function (array $data, View $view): array {
                return [
                    'id'       => $this->id,
                    'state'    => $state = $this->state($data),
                    'hidden'   => $state === 'closed',
                    'disabled' => $data['_disabled'] || $this->disabled,
                ];
            }
        );

        return $this->view('shadcn-ui::components.accordion.accordion-item');
    }
}
