<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Carousel;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * @property-read string $theme
 * @property-read string $orientation
 * @property-read array  $options
 */
class CarouselItem extends Component
{
    use SharesData;

    /**
     * Starting index of the carousel item.
     *
     * @var int
     */
    public static int $index = -1;

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

        self::$index++;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views: [
                'shadcn-ui::components.carousel.carousel-previous',
                'shadcn-ui::components.carousel.carousel-next',
            ],
            callback: fn(array $data, View $view) => [
                'index' => self::$index,
            ]
        );

        return $this->view('shadcn-ui::components.carousel.carousel-item');
    }
}
