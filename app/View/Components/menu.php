<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class menu extends Component
{
    public string $main_page;
    public string $main_link;

    public function __construct(string $main_page = 'Workers', string $main_link = 'workers.index')
    {
        $this->main_page = $main_page;
        $this->main_link = $main_link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu');
    }
}
