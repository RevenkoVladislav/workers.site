<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $classes;
    public string $label;
    public string $type;
    public string $id;
    public ?Model $model;
    public string $placeholder;
    public function __construct(string $name, string $label, ?Model $model = null, string $type = 'text', string $placeholder = '', string $classes = 'mb-3')
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->classes = $classes;
        $this->model = $model;
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
