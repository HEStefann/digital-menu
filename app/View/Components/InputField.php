<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    public $name;
    public $type;
    public $label;
    public $id;
    public $placeholder;
    public $icon;
    public $value;
    public $model;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $type, $id, $icon = '', $label = null, $placeholder = '', $value = '', $model = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->icon = $icon;
        $this->label = $label;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
