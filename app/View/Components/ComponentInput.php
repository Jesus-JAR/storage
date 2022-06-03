<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ComponentInput extends Component
{
    public string $label;
    public string $placeholder;
    public string $name;
    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $placeholder, string $name, string $type = 'text')
    {
        //
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.component-input');
    }
}
