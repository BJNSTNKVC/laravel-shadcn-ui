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
class CarouselNext extends Component
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
     * @param array $options
     * @param int   $index
     *
     * @return bool
     */
    private function disabled(array $options, int $index): bool
    {
        if (isset($options['loop']) && $options['loop']) {
            return false;
        }

        if (isset($options['startIndex'])) {
            return $options['startIndex'] === $index;
        }

        return $index === 0;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views: [
                'shadcn-ui::components.carousel.carousel-next',
            ],
            callback: fn(array $data, View $view) => [
                'disabled' => $this->disabled($data['options'], $data['index']),
            ]
        );

        return $this->view('shadcn-ui::components.carousel.carousel-next');
    }
}
