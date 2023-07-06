<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class itemButton extends Component
{
    public $name;
    public $route;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $route)
    {
        $this->name = $name;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-button');
    }
}
