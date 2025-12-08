<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $id;
    public $type;
    public $name;
    public $value;
    public $isRequired;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $id = "",
        $label = "",
        $type = "text",
        $name = "",
        $value = "",
        $isRequired = false,
    ) {
        $this->label = $label;
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->isRequired = $isRequired;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}
