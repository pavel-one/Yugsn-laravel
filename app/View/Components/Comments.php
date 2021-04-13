<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Comments extends Component
{
    private $id;
    private $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $class)
    {
        $this->id = $id;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.comments');
    }
}
