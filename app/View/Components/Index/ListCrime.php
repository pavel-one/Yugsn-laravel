<?php

namespace App\View\Components\Index;

use App\Models\MaterialCategory;
use App\Models\UserMaterial;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListCrime extends Component
{
    /** @var UserMaterial[]  */
    public $materials;

    /** @var MaterialCategory */
    public $category;

    /**
     * Create a new component instance.
     *
     * @param $categoryName
     * @param $limit
     */
    public function __construct($categoryName, $limit)
    {
        /** @var MaterialCategory $category */
        $this->category = $category = MaterialCategory::whereName($categoryName)->first();

        if (!$category) {
            return false;
        }

        $this->materials = UserMaterial::findMini($category, true)
            ->limit($limit)
            ->get()
            ->all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.index.list-crime', [
            'materials' => $this->materials,
            'category' => $this->category
        ]);
    }
}
