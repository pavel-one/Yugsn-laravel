<?php

namespace App\View\Components\Index;

use App\Models\MaterialCategory;
use Illuminate\View\Component;

class ListCategories extends Component
{
    private $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = \Cache::remember('index-list-categories', 60 * 10, function () {
            return MaterialCategory::all();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.index.list-categories', [
            'categories' => $this->categories
        ]);
    }
}
