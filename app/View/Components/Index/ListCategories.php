<?php

namespace App\View\Components\Index;

use App\Models\MaterialCategory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListCategories extends Component
{
    public const EXCLUDE_CAT = [
        'Криминал', 'Общество', 'Колумнистика'
    ];

    private $categories;

    /**
     * Create a new component instance.
     *
     * @param $limit
     * @param $offset
     */
    public function __construct(int $limit, int $offset)
    {
        $this->categories = \Cache::remember("index-list-categories-$limit-$offset", 60 * 10, function () use ($limit, $offset) {
            return MaterialCategory::orderBy('sort')
                ->whereNotIn('name', self::EXCLUDE_CAT)
                ->limit($limit)
                ->offset($offset)
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
