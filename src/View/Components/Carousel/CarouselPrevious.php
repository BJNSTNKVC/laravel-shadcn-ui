<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Carousel;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 * @property-read string $orientation
 * @property-read array  $options
 * @property-read bool   $disabled
 * @property-read int    $index
 */
class CarouselPrevious extends Component
{
    use SharesData;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $asChild = false)
    {
        $this->asChild = $asChild;
    }

    /**
     * Determine if the button should be disabled.
     *
     * @param  array  $options
     *
     * @return bool
     */
    private function disabled(array $options): bool
    {
        if (isset($options['loop']) && $options['loop']) {
            return false;
        }

        if (isset($options['startIndex'])) {
            return $options['startIndex'] === 0;
        }

        return true;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views: [
                'shadcn-ui::components.carousel.carousel-previous',
            ],
            callback: fn(array $data, View $view) => [
                'disabled' => $this->disabled($data['options']),
            ]
        );

        return $this->view('shadcn-ui::components.carousel.carousel-previous');
    }
}
