<?php

namespace Bjnstnkvc\ShadcnUi\View\Components\Carousel;

use Bjnstnkvc\ShadcnUi\View\Concerns\SharesData;
use Illuminate\View\Component;
use Illuminate\View\View;

class Carousel extends Component
{
    use SharesData;

    /**
     * The style theme of the component.
     *
     * @var string
     */
    public string $theme;

    /**
     * The orientation of the carousel.
     *
     * @var string
     */
    public string $orientation;

    /**
     * The options of the carousel.
     *
     * @var array
     */
    public array $options;

    /**
     * The plugins of the carousel.
     *
     * @var array
     */
    public array $plugins;

    /**
     * Change the default rendered element for the one passed as a child, merging their props and behavior.
     *
     * @var bool
     */
    public bool $asChild;

    /**
     * Create a new component instance.
     */
    public function __construct(string $theme = 'default', string $orientation = 'horizontal', array|string $options = [], array $plugins = [], bool $asChild = false)
    {
        $this->theme       = $theme;
        $this->orientation = $orientation;
        $this->options     = array_merge($options, ['orientation' => $orientation]);
        $this->plugins     = $plugins;
        $this->asChild     = $asChild;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        $this->share(
            views   : [
                'shadcn-ui::components.carousel.carousel-content',
                'shadcn-ui::components.carousel.carousel-item',
                'shadcn-ui::components.carousel.carousel-previous',
                'shadcn-ui::components.carousel.carousel-next',
            ],
            callback: fn(array $data, View $view) => [
                'theme'       => $this->theme,
                'orientation' => $this->orientation,
                'options'     => $this->options,
            ]
        );

        return $this->view('shadcn-ui::components.carousel.carousel');
    }
}
