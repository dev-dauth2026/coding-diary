<?php

namespace App\View\Components\head;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class prism-highlighter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.head.prism-highlighter');
    }
}
