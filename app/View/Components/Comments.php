<?php

namespace App\View\Components;

use App\Models\UserMaterial;
use Illuminate\View\Component;

class Comments extends Component
{
    private $material;
    private $comments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->material = UserMaterial::whereId($id)->first();
        $this->comments = $this->material->comments()->get()->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.comments', [
            'material' => $this->material,
            'comments' => $this->comments
        ]);
    }
}
