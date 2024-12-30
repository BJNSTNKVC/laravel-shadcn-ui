<?php

namespace Bjnstnkvc\ShadcnUi\View\Concerns;

use Closure;
use Illuminate\View\View;

trait SharesData
{
    /**
     * Shared the data to the view.
     *
     * @param array   $views
     * @param Closure $callback
     *
     * @return void
     */
    public function share(array $views, Closure $callback): void
    {
        $this->factory()
            ->composer(
                views   : $views,
                callback: fn(View $view) => $view->with($callback($view->getData(), $view))
            );
    }
}
