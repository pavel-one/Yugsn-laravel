<?php

namespace App\View\Components\Index;

use App\Models\MaterialCategory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListCategories extends Component
{
    private $categories;

    /**
     * Create a new component instance.
     *
     * @param $limit
     * @param $offset
     */
    public function __construct($limit, $offset)
    {
        $this->categories = \Cache::remember('index-list-categories', 60 * 10, function () use ($limit, $offset) {
            return MaterialCategory::orderBy('sort')
                ->limit((int) $limit)
                ->offset((int) $offset)
                ->get()
                ->all();
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.index.list-categories', [
            'categories' => $this->categories,

        ]);
    }
}
