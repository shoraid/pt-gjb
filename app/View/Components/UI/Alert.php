<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    // public array $items;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public mixed $type,
        public mixed $message,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.alert');
    }
}
