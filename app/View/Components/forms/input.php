<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    public string $name;
    public string $classes;
    public string $label;
    public string $type;
    public string $id;
    public function __construct(string $name, string $label, string $type = 'text', string $classes = 'mb-3')
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->classes = $classes;
        $this->id = uniqid();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input');
    }
}
